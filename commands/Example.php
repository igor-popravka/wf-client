<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('APIClassName');
$this->setAPIMethod('APIClassMethodName');

$this->setAPIParamsMode($this::PARAMS_AS_VALUES); // one of the Command::PARAMS_AS_VALUES | Command::PARAMS_AS_OBJECT
 
$this->setResponseTemplate($this::RESPONSE_TEMP_PREFORMAT);

$p = $this->createParam('account'); //return Param object
$p->type = $comments::PTYPE_MULTITEXT; // set Param type
$p->label = 'Account'; // set Param label
$p->required = true; // is required
$p->validate = function ($param, $response) {
    /**
     * @var \DC\WFAPI\GUI\Param $param
     * @var \DC\WFAPI\GUI\Response $response
     */
    if (empty($param->value)) {
        // do something with $param
    } else {
        $response->addError("Param {$param->name} should be filled");
    }
};