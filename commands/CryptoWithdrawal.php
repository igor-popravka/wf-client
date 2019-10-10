<?php

use \DC\WFAPI\GUI\Param;

/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createCryptoWithdrawal');

$p = $this->createParam('account');
$p->required = true;
$p->validate = function ($field, $response) {
    /**
     * @var \DC\WFAPI\GUI\Param $field
     * @var \DC\WFAPI\GUI\Response $response
     */
    if (strlen($field->value) !== 7) {
        $response->addError("Field <b>'Account'</b> length should be in 7 chars.");
    }
};

$this->createParam('sub_account')->label = 'Sub-Account';
$this->createParam('amount');

$p = $this->createParam('currency');
$p->type = $p::PTYPE_CURRENCY;

//$this->createParam('transfer_fee')->value = 0;
//$this->createParam('transfer_fee_currency')->setProperties([
//    'type'=> Param::PTYPE_CURRENCY
//]);
//$this->createParam('to_comment')->label = 'Comment';
//$this->createParam('payment_details');
$this->createParam('description');

//$this->createParam('trid')->label = 'Transaction ID';

//$this->createParam('withdrawal_type')->setProperties([
//    'type'=> Param::PTYPE_WITHDRAWAL_TYPE
//]);

$p = $this->createParam('close_account');
$p->type = $p::PTYPE_BOOLEAN;
$p->label = 'Close Account';

//$p = $this->createParam('withdrawal_currency');
//$p->type = $p::PTYPE_CURRENCY;

//$this->createParam('beneficiary_name');
//$this->createParam('beneficiary_address');
//$this->createParam('beneficiary_city');
//$this->createParam('beneficiary_country');

//$this->createParam('to_iban')->label = 'IBAN';

//$this->createParam('to_bank_name')->label = 'Name of the Bank';
//$this->createParam('to_bank_address')->label = 'Address of the Bank';
//$this->createParam('to_bic_swift')->label = 'BIC/SWIFT';

//$this->createParam('to_branch_name')->label = 'Branch Name';
//$this->createParam('to_bank_account_type')->label = 'Bank Account Type';
//$this->createParam('to_bank_account_holder')->label = 'Bank Account Holder';
//$this->createParam('to_intermediary_bank')->label = 'Intermediary Bank';

$p = $this->createParam('send_to_cfm');
$p->type = $p::PTYPE_BOOLEAN;
$p->label = 'Send to CFM';

$p = $this->createParam('full');
$p->type = $p::PTYPE_BOOLEAN;
$p->label = 'Full Withdrawal';

$p = $this->createParam('run_workflow');
$p->type = $p::PTYPE_BOOLEAN;

