<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createQuickDeposit');

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

$trid = $this->createParam('trid');
$trid->required = true;
$trid->label = 'TRID';
$trid->value = 'TRANSACTION-ID-' . time();

$country = $this->createParam('country_of_origin');
$country->required = false;
$country->label = 'Country Of Origin';
$country->type = $country::PTYPE_COUNTRIES;

$p = $this->createParam('qd_bank');
$p->required = true;
$p->label = 'QD_BANK';
$p->type = $country::PTYPE_QD_BANK_LIST;
$p->data = 'JPN';

$p = $this->createParam('qd_payer_name');
$p->required = true;
$p->label = 'QD_PAYER_NAME';

$this->createParam('description');

$p = $this->createParam('run_workflow');
$p->type = $p::PTYPE_BOOLEAN;
$p->value = 1;