<?php
namespace DC\WFAPI\GUI;


class Response {
    const FORMAT_HTML = 'html';
    const FORMAT_JSON = 'json';

    /** @var array */
    private $render_data;
    
    private $errors = [];
    private $warnings = [];
    
    private static $instance;

    private function __construct() {
    }

    public static function instance() {
        if(!isset(self::$instance)){
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function renderTemplate($template, array $render_data = []) {
        $path = sprintf('%stemplates/response/%s.phtml', DIR_ROOT, $template);
        
        if (!is_readable($path)) {
            throw new Exception("Template {$template} is not readable.");
        }

        $this->render_data[$template] = $render_data;
        ob_start();
        require($path);
        $content = ob_get_contents();
        ob_clean();
        return $content;
    }

    public function flash($format = self::FORMAT_HTML) {
        switch ($format) {
            case self::FORMAT_JSON:
                echo json_encode($this->render_data['response']);
                break;
            case self::FORMAT_HTML:
            default:
                $base_template = Config::getItem('base_template', Config::SECTION_GENERAL);

                if (!is_readable($base_template)) {
                    throw new Exception("Base template {$base_template} is not readable.");
                }

                ob_start();
                require($base_template);
                ob_end_flush();
        }
    }

    public function getRenderData($name) {
        return isset($this->render_data[$name]) ? $this->render_data[$name] : '';
    }

    public function setRenderData($name, $data) {
        $this->render_data[$name] = $data;
    }

    public function addError($message) {
        $this->errors[] = $message;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function hasErrors() {
        return count($this->errors);
    }

    public function addWarning($message) {
        $this->warnings[] = $message;
    }

    public function getWarnings() {
        return $this->warnings;
    }

    public function hasWarnings() {
        return count($this->warnings);
    }
}