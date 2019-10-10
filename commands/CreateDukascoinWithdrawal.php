<?php

use \DC\WFAPI\GUI\Param;

/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createDukascoinWithdrawal');

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
$this->createParam('amount')->required = true;

$p = $this->createParam('currency');
$p->value = 'DCO';

$this->createParam('description');

$this->createParam('eth_address')->required = true;

$this->createParam('risk_score');

$p = $this->createParam('processing_type');
$p->source = ['M'=>'Manual', 'A'=>'Auto'];
$p->type = $p::PTYPE_LIST;

$p = $this->createParam('run_workflow');
$p->type = $p::PTYPE_BOOLEAN;

