<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Account');
$this->setAPIMethod('getInfo');
$this->setAPIParamsMode($this::PARAMS_AS_VALUES);

$this->setResponseTemplate($this::RESPONSE_TEMP_STDOBJECT);

$this->createParam('account')->required = true;
