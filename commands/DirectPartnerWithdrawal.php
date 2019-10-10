<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('directPartnerWithdrawal');

$this->createParam('amount')->required = true;

$currency = $this->createParam('currency');
$currency->required = true;
$currency->type = $currency::PTYPE_CURRENCY;

$to_iban = $this->createParam('to_iban');
$to_iban->required = true;
$to_iban->label = 'IBAN';

$bank_name = $this->createParam('to_bank_name');
$bank_name->required = true;
$bank_name->label = 'Bank Name';

$bic_swift = $this->createParam('to_bic_swift');
$bic_swift->required = true;
$bic_swift->label = 'Bic Swift';

$bic_swift = $this->createParam('to_bank_address');
$bic_swift->required = true;
$bic_swift->label = 'Bank address';