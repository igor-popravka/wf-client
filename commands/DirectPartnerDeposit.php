<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('directPartnerDeposit');

$this->createParam('amount')->required = true;

$currency = $this->createParam('currency');
$currency->required = true;
$currency->type = $currency::PTYPE_CURRENCY;

$trid = $this->createParam('trid');
$trid->required = true;
$trid->label = 'TRID';
$trid->value = 'TRANSACTION-ID-' . time();

$country = $this->createParam('country_of_origin');
$country->required = true;
$country->label = 'Country Of Origin';
$country->type = $country::PTYPE_COUNTRIES;

$this->createParam('card_holder')->required = true;
$this->createParam('card_number')->required = true;
$this->createParam('card_bin')->required = true;