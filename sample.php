<?php
require_once dirname(__FILE__).'/omise_test/OmiseAccountTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseBalanceTest.php';

try {
// 	$accountTest = new OmiseAccountTest('pkey_test_4y9cewl0s1osh44ouud', 'skey_test_4y9cewl0rgwji2kbbcb');
// 	$accountTest->retrieve();
	
	$balanceTest = new OmiseBalanceTest('pkey_test_4y9cewl0s1osh44ouud', 'skey_test_4y9cewl0rgwji2kbbcb');
	$balanceTest->retrieve();
	
} catch(OmiseException $e) {
	var_dump($e);
}

exit;
