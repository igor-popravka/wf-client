<?php

namespace DC\WFAPI\GUI;

use DC\Workflow\Client;
use DC\Workflow\Exception;
use DC\Workflow\UnknownException;

class Tester {
    /** @var Command */
    private $command;

    public function __construct() {
        $this->init();
    }

    public function run() {
        switch ($this->getParam('tester_action')) {
            case 'run';
                $this->runCommand();
                exit;
            case 'callback':
                file_put_contents(DIR_ROOT . 'temp/callback.log', var_export([$_POST, $_GET, $_REQUEST], true));
                exit(200);
            default:
                $this->viewCommand();
        }

        $this->render();
    }

    /**
     * Render base template by response data and write response in out stream
     */
    protected function render() {
        $commands = array_map(function ($c) {
            return $c['title'];
        }, Config::getAllCommands());
        asort($commands);

        Response::instance()->setRenderData('menu_list', $commands);

        $command = $this->getCommand();
        Response::instance()->setRenderData('command_id', !empty($command) ? $command->name : "");

        Response::instance()->flash();
    }

    private function init() {
        set_exception_handler([$this, 'exceptionHandler']);
    }

    /**
     * Executes current command (Run WF API method)
     *
     * @throws Exception
     */
    protected function runCommand() {
        /** @var Command $command */
        $command = $this->getCommandFromPOST();

        //validate params
        $command->validate();
        if (Response::instance()->hasErrors()) {
            Response::instance()->setRenderData('response', [
                'status' => 'error',
                'errors' => Response::instance()->getErrors(),
            ]);
        } else {
            try {
                $rpc = new Client(
                    Config::getItem($command->getParam('environment', Command::SECTION_API_DATA)->value, Config::SECTION_ENVIRONMENTS),
                    Config::getItem('name', Config::SECTION_SESSION)
                );
                $rpc->setDebug(true)->auth(
                    $command->getParam('instance', Command::SECTION_API_DATA)->value,
                    $command->getParam('application', Command::SECTION_API_DATA)->value,
                    Config::getItem($command->getParam('application', Command::SECTION_API_DATA)->value, Config::SECTION_API_KEYS)
                );

                if ($command->getAPIParamsMode() == Command::PARAMS_AS_OBJECT) {
                    $response = call_user_func([$rpc->{$command->getAPIClass()}, $command->getAPIMethod()], (object)$command->toArrayParams());
                } else {
                    $response = call_user_func_array([$rpc->{$command->getAPIClass()}, $command->getAPIMethod()], $command->toArrayParams());
                }

                $response = array_merge((array)$response, ['log_uid' => $rpc->getResponse()->getLogUid()]);

                Response::instance()->setRenderData('response', [
                    'status' => 'OK',
                    'raw' => var_export($response, true),
                    'formatted' => Response::instance()->renderTemplate($command->getResponseTemplate(), $response),
                ]);
            } catch (\Throwable $t) {
                /** @var Exception | UnknownException | \Throwable $t */
                Response::instance()->setRenderData('response', [
                    'status' => 'OK',
                    'raw' => var_export($t, true),
                    'formatted' => Response::instance()->renderTemplate('exception', [
                        'exception' => "[{$t->getCode()}] {$t->getMessage()}",
                        'data' => method_exists($t, 'getData') ? $t->getData() : [],
                        'trace' => $t->getTraceAsString(),
                        'log_uid' => $t->getLogUid()
                    ])
                ]);
            }
        }

        Response::instance()->flash(Response::FORMAT_JSON);
    }

    /**
     * Renders page by command data or display default view
     *
     * @throws Exception
     */
    protected function viewCommand() {
        /** @var Command $command */
        $command = $this->getCommand();
        if (!empty($command)) {
            $case_id = $this->getParam('case_id');
            if (strlen($case_id)) {
                $command->applyCase($case_id);
            }

            Response::instance()->setRenderData('command', $command);
        }
    }

    /**
     * @return Command <i>(оbject)</i> <b>Command</b> - contains the command data and methods for work with them
     * @throws Exception
     */
    protected function getCommand() {
        if (!isset($this->command)) {
            $command_name = isset($_GET['cmd']) ? $_GET['cmd'] : '';

            if (empty($command_name)) return null;

            if (!Config::getCommand($command_name)) {
                header('HTTP/1.0 400 Bad Request', true, 400);
                exit;
            }

            $data = Config::getCommand($command_name);
            $this->command = new Command(... array_values($data));
        }

        return $this->command;
    }

    /**
     * Gets POST parameter by name
     *
     * @param string $name
     * @return string
     */
    protected function getParam($name = '') {
        if (!empty($name) && isset($_POST[$name])) {
            return $_POST[$name];
        } else if (!empty($name) && isset($_GET[$name])) {
            return $_GET[$name];
        }

        return '';
    }

    /**
     * Prepares <i>(object)</i> <b>Form</b> from post data
     *
     * @return Command
     * @throws Exception
     */
    protected function getCommandFromPOST() {
        /** @var Command $command */
        $command = $this->getCommand();

        foreach ($command->getParams(null) as $name => $param) {
            /** @var Param $param */
            $param->value = $this->parseValue($this->getParam($name), $param->type);
        }
        return $command;
    }

    public function exceptionHandler($e) {
        /** @var Exception $e */
        $message = "EXCEPTION: [{$e->getCode()}] {$e->getMessage()}\n\n{$e->getTraceAsString()}\n";
        @error_log($message);

        if ($this->isAjax()) {
            Response::instance()->setRenderData('response', [
                'status' => 'ERROR',
                'errors' => [sprintf('Error: %s; in %s; on line: %d.', $e->getMessage(), $e->getFile(), $e->getLine())]
            ]);
            Response::instance()->flash(Response::FORMAT_JSON);
        } else {
            Response::instance()->addError($message);
            $this->command = null;
            $this->render();
        }
    }

    function isAjax() {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

    public function parseValue($value, $type) {
        if (is_numeric($value) && $type != Param::PTYPE_TEXT) {
            return floatval($value);
        } else if ($json_value = json_decode($value, true)) {
            return $json_value;
        } else {
            return strval($value);
        }
    }
}