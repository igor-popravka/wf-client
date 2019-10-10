<?php
/**
 * @author: igor.popravka
 * Date: 01.05.2017
 * Time: 16:04
 */

/** @var \DC\WFAPI\GUI\Command $this */
$this->setAPIClass('Workflow');
$this->setAPIMethod('createPaymentAccount');

$account = $this->createParam('account');
$account->required = true;
$account->validate = function ($field, $response) {
    /**
     * @var \DC\WFAPI\GUI\Param $field
     * @var \DC\WFAPI\GUI\Response $response
     */
    if (!preg_match('/^\d{7}$/', $field->value)) {
        $response->addError("Field <b>'Account'</b> has incorrect format.");
    }
};

$f = $this->createParam('send_email');
$f->type = $f::PTYPE_BOOLEAN;
$f->value = true;
