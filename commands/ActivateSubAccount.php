<?php
/** @var DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('activateSubAccount');

$this->createParam('account')->required = true;

$sub_account = $this->createParam('sub_account');
$sub_account->label = 'Sub-Account';
$sub_account->required = true;

//$run_workflow = $this->createParam('run_workflow');
//$run_workflow->type = $run_workflow::PTYPE_BOOLEAN;