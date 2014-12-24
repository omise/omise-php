<?php
require_once dirname(__FILE__).'/omise_test/OmiseAccountTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseBalanceTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseTokensTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseCustomersTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseCardsTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseChargesTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseTransfersTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseTransactionsTest.php';

try {
	// ---------- Account access test ----------
 	$accountTest = new OmiseAccountTest();
// 	$accountTest->retrieve();

	// ---------- Balance access test  ----------
 	$balanceTest = new OmiseBalanceTest();
// 	$balanceTest->retrieve();

	// ---------- Tokens access test  ----------
 	$tokenTest = new OmiseTokensTest();
// 	$tokenTest->create();
// 	$tokenTest->retrieve();

	// ---------- Customers access test  ----------
 	$customerTest = new OmiseCustomersTest();
// 	$customerTest->listAll();
// 	$customerTest->create();
// 	$customerTest->retrieve();
// 	$customerTest->update();
// 	$customerTest->destroy();

 	// ---------- Cards access test  ----------
 	$cardTest = new OmiseCardsTest();
// 	$cardTest->listAll();
//	$cardTest->retrieve();
//	$cardTest->update();
//	$cardTest->destroy();

 	// ---------- Charges access test  ----------
 	$chargeTest = new OmiseChargesTest();
// 	$chargeTest->listAll();
// 	$chargeTest->create();
// 	$chargeTest->retrieve();
//	$chargeTest->update();
//	$chargeTest->captureAnAuthorized();


 	// ---------- Transfers access test  ----------
 	$transferTest = new OmiseTransfersTest();
// 	$transferTest->listAll();
//	$transferTest->create();
//	$transferTest->retrieve();
//	$transferTest->update();
//	$transferTest->destroy();

 	// ---------- Transfers access test  ----------
 	$transactionTest = new OmiseTransactionsTest();
// 	$transactionTest->listAll();
// 	$transactionTest->retrieve();
} catch(OmiseException $e) {
	var_dump($e);
}

exit;
