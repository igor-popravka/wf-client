<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('getStatusList');
$this->setAPIParamsMode($this::PARAMS_AS_VALUES);

$this->setResponseTemplate($this::RESPONSE_TEMP_WF_LIST);

$p = $this->createParam('date_from');
$p->required = true;
$p->label = 'DATE_FROM';
$p->value = time() - 24 * 3600 * 30;

$p = $this->createParam('date_to');
$p->required = true;
$p->label = 'DATE_TO';
$p->value = time();

$p = $this->createParam('workflow_type_id');
$p->label = 'WORKFLOW_TYPE_ID';
$p->required = true;
$p->value = 43;