<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('cardCountryMismatch');

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

$this->createParam('card_country')->required = true;
$this->createParam('card_masked_number')->required = true;
$this->createParam('card_hash')->required = true;
$this->createParam('card_bin')->required = true;
$this->createParam('card_holder')->required = true;