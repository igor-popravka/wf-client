<?php

use \DC\WFAPI\GUI\Param;

/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createSkrillNetellerClientVerification');

$this->createParam('account_number')->setProperties([
    'required' => true
]);
$this->createParam('customer_email')->setProperties([
    'required' => true
]);
$this->createParam('service_provider')->setProperties([
    'type' => Param::PTYPE_WITHDRAWAL_TYPE,
    'required' => true
]);
$this->createParam('name')->setProperties([
    'required' => true,
    'type'=> Param::PTYPE_SKRILL_NETELLER_MATCHES_TYPE
]);
$this->createParam('surname')->setProperties([
    'required' => true,
    'type'=> Param::PTYPE_SKRILL_NETELLER_MATCHES_TYPE
]);
$this->createParam('country')->setProperties([
    'required' => true,
    'type'=> Param::PTYPE_SKRILL_NETELLER_MATCHES_TYPE
]);
$this->createParam('birthday')->setProperties([
    'required' => true,
    'type'=> Param::PTYPE_SKRILL_NETELLER_MATCHES_TYPE
]);
$this->createParam('house_number')->setProperties([
    'required' => true,
    'type'=> Param::PTYPE_SKRILL_NETELLER_MATCHES_TYPE
]);
$this->createParam('postcode')->setProperties([
    'required' => true,
    'type'=> Param::PTYPE_SKRILL_NETELLER_MATCHES_TYPE
]);

$this->createParam('run_workflow')->setProperties([
    'type' => Param::PTYPE_BOOLEAN,
    'value' => 1
]);