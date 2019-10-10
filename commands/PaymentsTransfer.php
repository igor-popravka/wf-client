<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createPaymentsTransfer');

$account = $this->createParam('from_account_number');
$account->required = true;
$account->label = 'From Account';

$sub_account = $this->createParam('from_sub_account_number');
$sub_account->required = true;
$sub_account->label = 'From Sub-Account';

$this->createParam('amount')->required = true;

$currency = $this->createParam('currency');
$currency->required = true;
$currency->type = $currency::PTYPE_CURRENCY;