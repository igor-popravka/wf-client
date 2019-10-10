<?php
/** @var \DC\WFAPI\GUI\Command $this */
use \DC\WFAPI\GUI\Param;

$this->setAPIClass('Workflow');
$this->setAPIMethod('createPaysafeWithdrawal');

$account = $this->createParam('account')->setProperties([
    'required' => true,
    'validate' => function ($field, $response) {
        /**
         * @var \DC\WFAPI\GUI\Param $field
         * @var \DC\WFAPI\GUI\Response $response
         */
        if (!preg_match('/\d{7}(?:\.\d{4}\w{3})?/', $field->value)) {
            $response->addError("Field <b>'Account'</b> has incorrect format.");
        }
    }
]);

$this->createParam('sub_account')->label = 'Sub-Account';

$this->createParam('amount')->required = true;

$this->createParam('currency')->setProperties([
    'required' => true,
    'type' => Param::PTYPE_CURRENCY
]);

$this->createParam('transfer_fee');
$this->createParam('to_comment');
$this->createParam('payment_details');
$this->createParam('description');
$this->createParam('trid');

$this->createParam('withdrawal_currency')->setProperties([
    'type' => Param::PTYPE_CURRENCY
]);

$this->createParam('withdrawal_type')->setProperties([
    'type' => Param::PTYPE_WITHDRAWAL_TYPE,
]);

$this->createParam('run_workflow')->setProperties([
    'type' => Param::PTYPE_BOOLEAN,
    'value' => false
]);