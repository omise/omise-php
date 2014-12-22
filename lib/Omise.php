<?php
require_once dirname(__FILE__).'/omise/OmiseAccount.php';
require_once dirname(__FILE__).'/omise/OmiseBalance.php';
require_once dirname(__FILE__).'/omise/OmiseTokens.php';
require_once dirname(__FILE__).'/omise/OmiseCharges.php';
require_once dirname(__FILE__).'/omise/OmiseCustomers.php';
require_once dirname(__FILE__).'/omise/OmiseTransfers.php';
require_once dirname(__FILE__).'/omise/OmiseTransactions.php';


$object = OmiseCustomers::retrive()->getCards();
foreach ($object as $row) {
	echo($row['id']);
}
var_dump($object->retrieve('cust_test_4ybbcn4ej78uojo8ctw'));