<?php

use DC\WFAPI\GUI\Param;

/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createCardConnectumDeposit');

$param = $this->createParam('account');
$param->required = true;
$param->validate = function ($field, $response) {
    /**
     * @var Param $field
     * @var \DC\WFAPI\GUI\Response $response
     */
    if (!preg_match('/\d{7}(?:\.\d{4}\w{3})?/', $field->value)) {
        $response->addError("Field <b>'Account'</b> has incorrect format.");
    }
};

$this->createParam('sub_account')->label = 'Sub-Account';
$this->createParam('amount')->required = true;

$param = $this->createParam('currency');
$param->required = true;
$param->type = Param::PTYPE_CURRENCY;

$param = $this->createParam('trid');
$param->label = 'TRID';
$param->value = 'TRANSACTION-ID-' . time();

$this->createParam('external_uid')->setProperties([
    'label' => 'External UID'
]);

$param = $this->createParam('country_of_origin');
$param->label = 'Country Of Origin';
$param->type = Param::PTYPE_COUNTRIES;

$this->createParam('card_holder')->required = true;
$this->createParam('card_number')->required = true;
$this->createParam('card_bin')->required = true;

$this->createParam('card_fee_amount')->required = true;
$param = $this->createParam('card_fee_currency');
$param->required = true;
$param->type = Param::PTYPE_CURRENCY;

$this->createParam('card_fee')->label = 'Card Interest Rate';

$this->createParam('description')->type = Param::PTYPE_TEXT;

$param = $this->createParam('user_ip');
$param = $this->createParam('user_ip_country');
$param->type = Param::PTYPE_COUNTRIES;

$this->createParam('3d_status')->type = Param::PTYPE_THIRD_STATUS;