<?php
/**
 * Created by PhpStorm.
 * User: mykola.koliesnik
 * Date: 5/29/2017
 * Time: 9:04 PM
 */

/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createEKSDeposit');

$account = $this->createParam('account');
$account->required = true;
$account->validate = function ($field, $response) {
    /**
     * @var \DC\WFAPI\GUI\Param $field
     * @var \DC\WFAPI\GUI\Response $response
     */
    if (strlen($field->value) !== 7) {
        $response->addError("Field <b>'Account'</b> length should be in 7 chars.");
    }
};

$this->createParam('sub_account')->label = 'Sub-Account';
$this->createParam('amount')->required = true;

$currency = $this->createParam('currency');

$currency->required = true;
$currency->value = 'EUR';
//$currency->type = $currency::PTYPE_CURRENCY;

$trid = $this->createParam('trid');
$trid->required = true;
$trid->label = 'TRID';
$trid->value = 'TRANSACTION-ID-' . time();

$cred_counterparty_name = $this->createParam('cred_counterparty_name');
$cred_counterparty_name->required = true;
$cred_counterparty_name->label  = 'Beneficiary name';