<?php
require_once dirname(__FILE__).'/omise/OmiseAccount.php';
require_once dirname(__FILE__).'/omise/OmiseBalance.php';
require_once dirname(__FILE__).'/omise/OmiseTokens.php';
require_once dirname(__FILE__).'/omise/OmiseCharges.php';
require_once dirname(__FILE__).'/omise/OmiseCustomers.php';
require_once dirname(__FILE__).'/omise/OmiseTransfers.php';
require_once dirname(__FILE__).'/omise/OmiseTransactions.php';


$object = OmiseCustomers::retrieve('cust_test_4ybb7u8xcwrptxjv873')->getCards()->retrieve('card_test_4ybb7ru7h9nv1hasd0v');
$object->update(array(
	'expiration_month' => 11,
	'expiration_year' => 2017,
	'name' => 'Somchai Praset Updated',
	'postal_code' => '10310'
));
var_dump($object);