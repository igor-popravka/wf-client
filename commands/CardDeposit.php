<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createCardDeposit');

$account = $this->createParam('account');
$account->required = true;
$account->validate = function ($field, $response) {
    /**
     * @var \DC\WFAPI\GUI\Param $field
     * @var \DC\WFAPI\GUI\Response $response
     */
    if (!preg_match('/\d{7}(?:\.\d{4}\w{3})?/', $field->value)) {
        $response->addError("Field <b>'Account'</b> has incorrect format.");
    }
};

$this->createParam('sub_account')->label = 'Sub-Account';
$this->createParam('amount')->required = true;

$currency = $this->createParam('currency');
$currency->required = true;
$currency->type = $currency::PTYPE_CURRENCY;

$trid = $this->createParam('trid');
$trid->label = 'TRID';
$trid->value = md5('TRANSACTION-ID-' . time());

$country = $this->createParam('country_of_origin');
$country->label = 'Country Of Origin';
$country->type = $country::PTYPE_COUNTRIES;

$this->createParam('card_holder')->required = true;
$this->createParam('card_number')->required = true;
$this->createParam('card_bin')->required = true;

$this->createParam('3d_status')->type = $country::PTYPE_THIRD_STATUS;
$f = $this->createParam('user_ip');
$f = $this->createParam('user_ip_country');
$f->type = $country::PTYPE_COUNTRIES;

$this->createParam('description');