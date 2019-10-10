<?php
use DC\WFAPI\GUI\Config;

/** REGISTER CONFIGURATION DATA */
Config::registerItem('name', 'wf2', Config::SECTION_SESSION);
Config::registerItem('base_template', DIR_ROOT . 'templates/page.index.phtml', Config::SECTION_GENERAL);

Config::registerSection(Config::SECTION_INSTANCES, [
    'pre_eur' => 'Pre EUR',
    'pre_gva' => 'Pre GVA',
    'pre_pay' => 'Pre PAY',
    'pre_jpn' => 'Pre JAPAN',
    'pre_int' => 'Pre INT',
]);

Config::registerSection(Config::SECTION_API_KEYS, [
    'EBANK' => 'G9571V9x1l7p5k18162MJ14gD3jj7983RB5mYq1v2365D39216',
    'TransactPRO' => 'ezYS8eCJBLS7Zg4z6M6kyzm2qMcX88qSZQ4Z3dKqz4ypx4ka7e',
    'FXCOMM' => 'jZMqg3h5yYwXrbFnczsNjBLMQxm696un8KbFaX6nupYtD4QL8M',
    'FO' => 'jtWsn8JaKZJngEqcfdZxDsv68YFCxqcBerW2tsWtKSFK8n6bq5',
    'FO_DDS4' => 'xmNv6046F1dJ4A57H71694404NO805sc8LkL62244e5g4150DX',
    'PAYMENTS_API' => '6Nm3ZKKquCt4FWMNvuFkduPkNRW29Ym64S9qufGpUpp8HUhS5t',
    'WF' => 'CDQjwscJsrzPACXfI3h4okaKkKubhpfCpCKZBBhFET2mZ9gFlG',
    'WELBO' => 'MD844dxjm34829z050FC7tqFRLE714y80f56681P33Q55k6rcO',
    'CPAPI' => 'aDMm2cKxJjK7qFqW9SMJjJGT3jegvCBZQCd6JkhLDkpwLPsEd'
]);

Config::registerSection(Config::SECTION_ENVIRONMENTS, [
    'Localhost' => 'http://wf/api/',
    'Pre DEV' => 'https://devwf.php-test7.site.dukascopy.com/api/',
    'Pre DEMO' => 'https://prewf-eur.site.dukascopy.com/api/'
]);

/** REGISTER COMMANDS */
Config::registerCommand('AddAttachment', 'Add Attachment', 'Run WF API method <b>Workflow::addAttachment()</b>');
Config::registerCommand('ActivateSubAccount', 'Activate Sub-Account', 'Run WF API method <b>Workflow::activateSubAccount()</b>');
Config::registerCommand('CardCountryMismatch', 'Card Country Mismatch', 'Run WF API method <b>Workflow::cardCountryMismatch()</b>');
Config::registerCommand('CardDeposit', 'Card Deposit', 'Run WF API method <b>Workflow::createCardDeposit()</b>',
    DIR_ROOT . '/cases/deposit.case.json'
);
Config::registerCommand('CardWithdrawal', 'Card Withdrawal', 'Run WF API method <b>Workflow::createCardWithdrawal()</b>');
Config::registerCommand('createAccountLink', 'Create Account Link', 'Run WF API method <b>Workflow::createAccountLink()</b>');
Config::registerCommand('CreatePersonalAccount', 'Create Personal Account', 'Run WF API method <b>Workflow::CreatePersonalAccount()</b>');
Config::registerCommand('createSubAccount', 'Create Sub-Account', 'Run WF API method <b>Workflow::createSubAccount()</b>');
Config::registerCommand('createSelfTrader', 'Create Self Trader', 'Run WF API method <b>Community::createSelfTrader()</b>');
Config::registerCommand('deactivateSubAccount', 'Deactivate Sub-Account', 'Run WF API method <b>Workflow::deactivateSubAccount()</b>');
Config::registerCommand('DFCTransfer', 'Create DFC Transfer', 'Run WF API method <b>Workflow::createDFCTransfer()</b>');
Config::registerCommand('directPartnerDeposit', 'Direct Partner Deposit', 'Run WF API method <b>Workflow::directPartnerDeposit()</b>');
Config::registerCommand('directPartnerWithdrawal', 'Direct Partner Withdrawal', 'Run WF API method <b>Workflow::directPartnerWithdrawal()</b>');
Config::registerCommand('eurPartnerDeposit', 'EUR Partner Deposit', 'Run WF API method <b>Workflow::eurPartnerDeposit()</b>');
Config::registerCommand('GetAccountInfo', 'Get Account Info', 'Run WF API method <b>Account::getInfo()</b>');
Config::registerCommand('GetAccountPersons', 'Get Account Persons', 'Run WF API method <b>Account::getPersons()</b>');
Config::registerCommand('getStatusList', 'Get Status List', 'Run WF API method <b>Workflow::getStatusList()</b>');
Config::registerCommand('getInfoByTRID', 'Get Info By TRID', 'Run WF API method <b>Workflow::getInfoByTRID()</b>');
Config::registerCommand('PaymentsTransfer', 'Create Payments Transfer', 'Run WF API method <b>Workflow::createPaymentsTransfer()</b>', DIR_ROOT . '/cases/payment-transfer.case.json');
Config::registerCommand('PnlAdjustment', 'Create PnlAdjustment', 'Run WF API method <b>Workflow::createPnlAdjustment()</b>');
Config::registerCommand('QuickDeposit', 'Quick Deposit', 'Run WF API method <b>Workflow::createQuickDeposit()</b>');
Config::registerCommand('Transfer', 'Create Transfer', 'Run WF API method <b>Workflow::createTransfer()</b>');
Config::registerCommand('TransferBetweenPartners', 'Create Transfer Between Partners', 'Run WF API method <b>Workflow::createTransferBetweenPartners()</b>');
Config::registerCommand('TransferFromPayments', 'Create Transfer From Payments', 'Run WF API method <b>Workflow::createTransferFromPayments()</b>');
Config::registerCommand('WireDeposit', 'Create Wire Deposit', 'Run WF API method <b>Workflow::createWireDeposit()</b>');
Config::registerCommand('Withdrawal', 'Money Withdrawal', 'Run WF API method <b>Workflow::createWithdrawal()</b>', DIR_ROOT . '/cases/withdrawal.case.json');
Config::registerCommand('WorkflowLink', 'Workflow Link', 'Run WF API method <b>Workflow::link()</b>', DIR_ROOT . '/cases/workflow_link.case.json');
Config::registerCommand('InvoicePayment', 'Invoice Payment', 'Run WF API method <b>Workflow::createInvoicePayment()</b>');
Config::registerCommand('CreatePaymentAccount', 'Create Payment Account', 'Run WF API method <b>Workflow::createPaymentAccount()</b>');
Config::registerCommand('CreateEKSDeposit', 'Create EKS Deposit', 'Run WF API method <b>Workflow::createEKSDeposit()</b>');
Config::registerCommand('SkrillNetellerClientVerification', 'Create Skrill/Neteller Client Verification', 'Run WF API method <b>Workflow::createSkrillNetellerClientVerification()</b>', DIR_ROOT . '/cases/skrill_neteller_client_verification.case.json');
Config::registerCommand('CreatePaysafeDeposit', 'Create Skrill/Neteller Deposit', 'Run WF API method <b>Workflow::createPaysafeDeposit()</b>');
Config::registerCommand('GetCardWithdrawalFee', 'Get Card Withdrawal Fee', 'Run WF API method <b>Workflow::getCardWithdrawalFee()</b>');
Config::registerCommand('CardPaymentConnectumDeposit', 'Card Connectum Deposit', 'Run WF API method <b>Workflow::createCardConnectumDeposit()</b>');
Config::registerCommand('GetWFInfo', 'Get info by ID', 'Run WF API method <b>Workflow::getInfo()</b>');
Config::registerCommand('CryptoDeposit', 'Create Crypto Deposit', 'Run WF API method <b>Workflow::createCryptoDeposit()</b>');
Config::registerCommand('CryptoWithdrawal', 'Create Crypto Withdrawal', 'Run WF API method <b>Workflow::createCryptoWithdrawal()</b>');
Config::registerCommand('CreatePaysafeWithdrawal', 'Create Paysafe Withdrawal', 'Run WF API method <b>Workflow::createPaysafeWithdrawal()</b>');
Config::registerCommand('CreatePartnerTransfer', 'Create Partner Transfer', 'Run WF API method <b>Workflow::createPartnerTransfer()</b>');
Config::registerCommand('CreateDukascoinWithdrawal', 'Create Dukascoin Withdrawal', 'Run WF API method <b>Workflow::createDukascoinWithdrawal()</b>');