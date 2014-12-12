<?php
require_once dirname(__FILE__).'/omise_test/OmiseAccountTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseBalanceTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseTokensTest.php';

try {
// 	$accountTest = new OmiseAccountTest();
// 	$accountTest->retrieve();
	
// 	$balanceTest = new OmiseBalanceTest();
// 	$balanceTest->retrieve();
	
	
// 	$tokenTest = new OmiseTokensTest();
// 	$tokenTest->create();
// 	$tokenTest->retrieve('tokn_test_4ycu4exhnpni3yqbo9q');
	
	
} catch(OmiseException $e) {
	var_dump($e);
}

exit;
