<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createTransferFromPayments');

$account = $this->createParam('pay_account');
$account->required = true;
$account->label = 'Payment Account';

$account = $this->createParam('pay_holder_name');
$account->required = true;
$account->label = 'Payment Account Holder';

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

$parent_workflow = $this->createParam('parent_workflow');
$parent_workflow->required = true;
$parent_workflow->type = $parent_workflow::PTYPE_MULTITEXT;

$p = $this->createParam('run_workflow');
$p->type = $p::PTYPE_BOOLEAN;