<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createInvoicePayment');

$field = $this->createParam('invoice_reference');
$field->required = true;

$field = $this->createParam('amount');
$field->required = true;

$field = $this->createParam('currency');
$field->required = true;
$field->type = $field::PTYPE_CURRENCY;

$field = $this->createParam('invoice_type');
$field->required = true;

$field = $this->createParam('beneficiary_name');
$field->required = true;

$field = $this->createParam('tax_id_nr');

$field = $this->createParam('beneficiary_address');

$field = $this->createParam('beneficiary_bank');

$field = $this->createParam('beneficiary_account');

$field = $this->createParam('correspondent_bank');

$field = $this->createParam('payment_details');
$field->type = $field::PTYPE_MULTITEXT;

$field = $this->createParam('external_invoice_nr');
$field->required = true;

$field = $this->createParam('parent_workflow');
$field->type = $field::PTYPE_MULTITEXT;
$field->value = json_encode([
    'workflow_id' => 20921,
    'branch_id' => 'PAY',
    'name' => 'Invoice Payment - 4EW96RG549EWR4',
    'link' => 'http://wf/?a=workflow_edit&WORKFLOW_ID=20921'
]);