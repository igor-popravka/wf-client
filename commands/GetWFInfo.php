<?php

/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('getInfo');
$this->setAPIParamsMode($this::PARAMS_AS_VALUES);

$this->setResponseTemplate($this::RESPONSE_TEMP_PREFORMAT);

$this->createParam('ID')->required = true;