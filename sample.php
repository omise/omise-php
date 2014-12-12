<?php
require_once dirname(__FILE__).'/omise_test/OmiseAccountTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseBalanceTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseTokensTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseCustomersTest.php';

try {
// 	$accountTest = new OmiseAccountTest();
// 	$accountTest->retrieve();
	
// 	$balanceTest = new OmiseBalanceTest();
// 	$balanceTest->retrieve();
	
	
// 	$tokenTest = new OmiseTokensTest();
// 	$tokenTest->create();
// 	$tokenTest->retrieve();
	
	$customerTest = new OmiseCustomersTest();
	//$customerTest->listAll();
	$customerTest->create();
} catch(OmiseException $e) {
	var_dump($e);
}

exit;
