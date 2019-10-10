<?php

/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('getInfoByTRID');
$this->setAPIParamsMode($this::PARAMS_AS_VALUES);

$this->setResponseTemplate($this::RESPONSE_TEMP_PREFORMAT);

$this->createParam('TRID')->required = true;