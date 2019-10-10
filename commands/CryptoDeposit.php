<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createCryptoDeposit');

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

$trid = $this->createParam('trid');
$trid->required = true;
$trid->label = 'TRID';
$trid->value = time();

$this->createParam('amount')->required = true;

$currency = $this->createParam('currency');
$currency->value = 'BTC';

$this->createParam('description');