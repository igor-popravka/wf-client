<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createPnlAdjustment');

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
$currency->type = $currency::PTYPE_CURRENCY;

$this->createParam('description');

$country = $this->createParam('settlement_id');
$country->required = true;
$country->label = 'Settlement ID';