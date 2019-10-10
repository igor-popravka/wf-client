<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createTransfer');

$p = $this->createParam('from_account');
$p->label = 'From Account';
$p->required = true;
$p->validate = function ($field, $response) {
    /**
     * @var \DC\WFAPI\GUI\Param $field
     * @var \DC\WFAPI\GUI\Response $response
     */
    if (strlen($field->value) !== 7) {
        $response->addError("Field <b>'From Account'</b> length should be in 7 chars.");
    }
};

$p = $this->createParam('from_sub_account');
$p->label = 'From Sub-Account';
$p->required = true;

$p = $this->createParam('to_account');
$p->label = 'To Account';
$p->required = true;
$p->validate = function ($field, $response) {
    /**
     * @var \DC\WFAPI\GUI\Param $field
     * @var \DC\WFAPI\GUI\Response $response
     */
    if (strlen($field->value) !== 7) {
        $response->addError("Field <b>'To Account'</b> length should be in 7 chars.");
    }
};

$p = $this->createParam('to_sub_account');
$p->label = 'To Sub-Account';
$p->required = true;

$this->createParam('amount')->required = true;

$p = $this->createParam('currency');
$p->required = true;
$p->type = $p::PTYPE_CURRENCY;

$p = $this->createParam('close_account');
$p->label = 'Close Account';
$p->type = $p::PTYPE_BOOLEAN;
$p->value = 0;

$p = $this->createParam('full');
$p->label = 'Full Transfer';
$p->type = $p::PTYPE_BOOLEAN;
$p->value = 0;

$p = $this->createParam('run_workflow');
$p->label = 'Run Workflow';
$p->type = $p::PTYPE_BOOLEAN;
$p->value = 1;