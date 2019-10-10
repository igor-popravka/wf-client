<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('link');
$this->setResponseTemplate($this::RESPONSE_TEMP_STDOBJECT_LIST);

$field = $this->createParam('workflow_id');
$field->required = true;
$field->label = 'Workflow ID';
$field->type = $field::PTYPE_MULTITEXT;

$field = $this->createParam('link_workflow_data');
$field->label = 'Link Workflow data';
$field->type = $field::PTYPE_MULTITEXT;

$field = $this->createParam('link_field');
$field->label = 'link_field';