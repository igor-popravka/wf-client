<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('CreatePersonalAccount');

$this->createParam('account')->required = true;

$sub_account = $this->createParam('sub_account');
$sub_account->label = 'Sub-Account';
$sub_account->required = true;