<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createDFCTransfer');

$this->createParam('DFC_USER_ID')->required = true;
$this->createParam('DFC_ACCOUNT_NUMBER')->required = true;
$this->createParam('DFC_LOGIN')->required = true;
$this->createParam('DFC_NAME')->required = true;

$this->createParam('ACCOUNT_NUMBER')->required = true;
$this->createParam('SUB_ACCOUNT_NUMBER')->required = true;
$this->createParam('description');

$this->createParam('AMOUNT')->required = true;
$currency = $this->createParam('CURRENCY');
$currency->required = true;
$currency->type = $currency::PTYPE_CURRENCY;

$this->createParam('OTHER_DETAILS');
$this->createParam('DFC_EMAIL');

