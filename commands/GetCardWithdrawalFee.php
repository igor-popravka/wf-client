<?php

use \DC\WFAPI\GUI\Param;

/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('getCardWithdrawalFee');
$this->setResponseTemplate($this::RESPONSE_TEMP_STDOBJECT);

$f = $this->createParam('account');
$f->required = true;
$f->validate = function ($field, $response) {
    /**
     * @var \DC\WFAPI\GUI\Param $field
     * @var \DC\WFAPI\GUI\Response $response
     */
    if (strlen($field->value) !== 7) {
        $response->addError("Field <b>'Account'</b> length should be in 7 chars.");
    }
};

$f = $this->createParam('sub_account');
$f->label = 'Sub-Account';
$f->required = true;

$f = $this->createParam('currency');
$f->required = true;
$f->type = $f::PTYPE_CURRENCY;