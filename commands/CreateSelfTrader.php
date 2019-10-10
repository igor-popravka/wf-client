<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Community');
$this->setAPIMethod('createSelfTrader');

$account = $this->createParam('ACCOUNT_NUMBER');
$account->label = 'Account';
$account->required = true;

$sub_account = $this->createParam('SUB_ACCOUNT_NUMBER');
$sub_account->label = 'Sub-Account';
$sub_account->required = true;

$this->createParam('PROD_TYPE');

$run_workflow = $this->createParam('run_workflow');
$run_workflow->type = $run_workflow::PTYPE_BOOLEAN;
$run_workflow->value = 1;
