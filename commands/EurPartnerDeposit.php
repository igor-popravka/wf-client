<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('eurPartnerDeposit');

$this->createParam('amount')->required = true;

$currency = $this->createParam('currency');
$currency->required = true;
$currency->type = $currency::PTYPE_CURRENCY;

$trid = $this->createParam('trid');
$trid->required = true;
$trid->label = 'TRID';
$trid->value = 'TRANSACTION-ID-' . time();