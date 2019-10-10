<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createWireDeposit');

$account = $this->createParam('account');
$account->required = true;
$account->validate = function ($field, $response) {
    /**
     * @var \DC\WFAPI\GUI\Param $field
     * @var \DC\WFAPI\GUI\Response $response
     */
    if (preg_match('/(\d{7})|(\d{7}\.\d{4}\w{3})/', $field->value) === 0) {
        $response->addError("Field <b>'Account'</b> length should be in 7 chars.");
    }
};

$this->createParam('sub_account')->label = 'Sub-Account';
$this->createParam('amount')->required = true;

$currency = $this->createParam('currency');
$currency->required = true;
$currency->type = $currency::PTYPE_CURRENCY;

$trid = $this->createParam('trid');
$trid->required = true;
$trid->label = 'TRID';
$trid->value = 'TRANSACTION-ID-' . time();

$p = $this->createParam('swift_message');
$p->type = $p::PTYPE_MULTITEXT;