<?php
namespace DC\WFAPI\GUI;

class Command {
    const PARAMS_AS_OBJECT = 1;
    const PARAMS_AS_VALUES = 2;

    const SECTION_CUSTOM_DATA = 'custom_data';
    const SECTION_API_DATA = 'api_data';
    const SECTION_CASES_DATA = 'cases_data';

    const RESPONSE_TEMP_DEFAULT = 'default';
    const RESPONSE_TEMP_EXCEPTION = 'exception';
    const RESPONSE_TEMP_PREFORMAT = 'pre_format';
    const RESPONSE_TEMP_STDOBJECT = 'std_object';
    const RESPONSE_TEMP_STDOBJECT_LIST = 'std_object_list';
    const RESPONSE_TEMP_WF_LIST = 'wf_list';

    public $name;
    public $title = '';
    public $description = '';

    private $api_class = '';
    private $api_method = '';
    private $api_params_mode = self::PARAMS_AS_OBJECT;
    private $response_template = self::RESPONSE_TEMP_DEFAULT;
    private $params = [
        self::SECTION_API_DATA => [],
        self::SECTION_CASES_DATA => [],
        self::SECTION_CUSTOM_DATA => []
    ];
    private $cases = [];

    public function __construct($name, $title = '', $description = '', $cases_file = '') {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;

        if (!empty($cases_file) && is_readable($cases_file)) {
            $this->cases = json_decode(file_get_contents($cases_file), true);
            if (empty($this->cases)) {
                Response::instance()->addWarning("Failed to get cases from file {$cases_file}");
            } else {
                Response::instance()->setRenderData('case_list', $this->cases);
            }
        }

        $case_name = $this->createParam('case_name', self::SECTION_CASES_DATA);
        $case_name->type = Param::PTYPE_INPUT;
        $case_name->disabled = true;
        $case_name->placeholder = 'Select tests case';

        $case_id = $this->createParam('case_id', self::SECTION_CASES_DATA);
        $case_id->type = Param::PTYPE_HIDDEN;

        $instance = $this->createParam('instance', self::SECTION_API_DATA);
        $instance->value = 'pre_eur';
        $instance->type = Param::PTYPE_INSTANCE;

        $application = $this->createParam('application', self::SECTION_API_DATA);
        $application->value = 'EBANK';
        $application->type = Param::PTYPE_APPLICATION;

        $environment = $this->createParam('environment', self::SECTION_API_DATA);
        $environment->value = 'Localhost';
        $environment->label = 'URL';
        $environment->type = Param::PTYPE_ENVIRONMENT;

        $this->loadParams();
    }

    /**
     * @param string $name
     * @param string $section
     * @return Param
     */
    public function createParam($name, $section = self::SECTION_CUSTOM_DATA) {
        $this->params[$section][$name] = new Param ($name, $this);
        return $this->params[$section][$name];
    }

    public function getParams($section = self::SECTION_CUSTOM_DATA) {
        if (!empty($section)) {
            return $this->params[$section];
        } else {
            $params = [];
            foreach ($this->params as &$pms) {
                $params = array_merge($params, $pms);
            }
            return $params;
        }
    }

    /**
     * @param string $name
     * @param string $section one of the constant: SECTION_CUSTOM_DATA | SECTION_API_DATA | SECTION_CASES_DATA
     * @return Param
     * @throws Exception
     */
    public function getParam($name, $section) {
        if (isset($this->params[$section]) && $this->params[$section][$name]) {
            return $this->params[$section][$name];
        }
        throw Exception::create("Failed to get param \"{$name}\" from section \"{$section}\"");
    }

    public function setAPIClass($class) {
        $this->api_class = $class;
    }

    public function getAPIClass() {
        return $this->api_class;
    }

    public function setAPIMethod($method) {
        $this->api_method = $method;
    }

    public function getAPIMethod() {
        return $this->api_method;
    }

    public function setAPIParamsMode($mode = self::PARAMS_AS_OBJECT) {
        $this->api_params_mode = $mode;
    }

    public function getAPIParamsMode() {
        return $this->api_params_mode;
    }

    public function setResponseTemplate($template = self::RESPONSE_TEMP_DEFAULT) {
        $this->response_template = $template;
    }

    public function getResponseTemplate() {
        return $this->response_template;
    }

    public function applyCase($id) {
        foreach ($this->cases as $item => $case) {
            if ($item == $id) {
                $all_params = $this->getParams(null);
                $case_pms = isset($case['params']) ? $case['params'] : [];
                
                foreach ($case_pms as $case_pnm => $case_pvl) {
                    if (isset($all_params[$case_pnm])) {
                        /** @var Param $p */
                        $p = $all_params[$case_pnm];
                        $p->value = is_array($case_pvl) ? json_encode($case_pvl) : $case_pvl;
                        continue;
                    }
                }

                $this->getParam('case_name', self::SECTION_CASES_DATA)->value = $case['name'];
                $this->getParam('case_id', self::SECTION_CASES_DATA)->value = $id;
                break;
            }
        }
    }

    public function validate() {
        if(empty($this->api_class)){
            Response::instance()->addError("Cannot to defined API class for command {$this->name}");
        }
        
        if(empty($this->api_method)){
            Response::instance()->addError("Cannot to defined API method for command {$this->name}");
        }
        
        foreach ($this->getParams(null) as $p) {
            /** @var Param $p */
            $p->validate();
        }
    }

    public function toArrayParams($section = self::SECTION_CUSTOM_DATA) {
        $array = [];
        foreach ($this->getParams($section) as $p) {
            /** @var Param $p */
            $array[$p->name] = $p->value;
        }
        return $array;
    }

    private function loadParams() {
        require_once DIR_ROOT . "commands/{$this->name}.php";
    }
}