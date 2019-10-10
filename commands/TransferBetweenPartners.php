<?php
/** @var \DC\WFAPI\GUI\Command $this */

$this->setAPIClass('Workflow');
$this->setAPIMethod('createTransferBetweenPartners');

$this->createParam('amount')->required = true;

$p = $this->createParam('currency');
$p->required = true;
$p->type = $p::PTYPE_CURRENCY;

$p = $this->createParam('partner_from');
$p->required = true;
$p->label = 'Partner From';

$p = $this->createParam('partner_to');
$p->required = true;
$p->label = 'Partner To';

$trid = $this->createParam('trid');
$trid->required = true;
$trid->label = 'TRID';
$trid->value = 'TRANSACTION-ID-' . time();

//$this->createParam('description');

//$p = $this->createParam('run_workflow');
//$p->type = $p::PTYPE_BOOLEAN;