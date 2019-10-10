<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createSubAccount');

$this->createParam('account')->required = true;

$type = $this->createParam('sub_account_type');
$type->label = 'Sub-Account type';
$type->required = true;

$currency = $this->createParam('currency');
$currency->required = true;
$currency->type = $currency::PTYPE_CURRENCY;

$status = $this->createParam('sub_account_status');
$status->label = 'Sub-Account status';
$status->required = true;

$prod_type = $this->createParam('prod_type');
$prod_type->type = $prod_type::PTYPE_PRODUCT_TYPES;

$run_workflow = $this->createParam('run_workflow');
$run_workflow->type = $run_workflow::PTYPE_BOOLEAN;