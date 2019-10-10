<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('deactivateSubAccount');

$this->createParam('account')->required = true;

$sub_account = $this->createParam('sub_account');
$sub_account->label = 'Sub-Account';
$sub_account->required = true;

$reason = $this->createParam('reason');
$reason->type = $reason::PTYPE_MULTITEXT;

//$run_workflow = $this->createParam('run_workflow');
//$run_workflow->type = $run_workflow::PTYPE_BOOLEAN;