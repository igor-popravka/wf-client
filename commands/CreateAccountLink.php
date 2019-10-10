<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createAccountLink');

$this->createParam('account')->required = true;

$link_branch_id = $this->createParam('link_branch_id');
$link_branch_id->required = true;
$link_branch_id->type = $link_branch_id::PTYPE_BRANCHES;

$this->createParam('link_account')->required = true;
