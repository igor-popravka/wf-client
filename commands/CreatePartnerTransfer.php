<?php
use DC\WFAPI\GUI\Command;
use DC\WFAPI\GUI\Param;
use DC\WFAPI\GUI\Response;

/** @var Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createPartnerTransfer');

$p = $this->createParam('from_account');
$p->label = 'From Account';
$p->required = true;
$p->validate = function ($field, $response) {
    /**
     * @var Param $field
     * @var Response $response
     */
    if (strlen($field->value) !== 7) {
        $response->addError("Field <b>'From Account'</b> length should be in 7 chars.");
    }
};

$p = $this->createParam('from_sub_account');
$p->label = 'From Sub-Account';
$p->required = true;

$p = $this->createParam('to_account');
$p->label = 'To Account';
$p->required = true;
$p->validate = function ($field, $response) {
    /**
     * @var Param $field
     * @var Response $response
     */
    if (strlen($field->value) !== 7) {
        $response->addError("Field <b>'To Account'</b> length should be in 7 chars.");
    }
};

$p = $this->createParam('to_sub_account');
$p->label = 'To Sub-Account';
$p->required = true;

$p = $this->createParam('trid');
$p->label = 'Transaction ID';
$p->required = true;

$this->createParam('amount')->required = true;

$p = $this->createParam('currency');
$p->required = true;
$p->type = $p::PTYPE_CURRENCY;

$this->createParam('crypto_amount')->required = true;

$p = $this->createParam('crypto_currency')->required = true;

$this->createParam('crypto_rate')->required = true;

$this->createParam('partner_fee_amount');
$this->createParam('partner_fee_currency')->type = Param::PTYPE_CURRENCY;

$this->createParam('reference_trid');

$p = $this->createParam('run_workflow');
$p->label = 'Run Workflow';
$p->type = $p::PTYPE_BOOLEAN;