<?php
require_once dirname(__FILE__).'/omise_test/OmiseAccountTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseBalanceTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseTokensTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseCustomersTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseCardsTest.php';
require_once dirname(__FILE__).'/omise_test/OmiseChargesTest.php';

try {
	// ---------- Accessへの接続テスト ----------
 	$accountTest = new OmiseAccountTest();
// 	$accountTest->retrieve();

	// ---------- Balanceへの接続テスト ----------
 	$balanceTest = new OmiseBalanceTest();
// 	$balanceTest->retrieve();

	// ---------- Tokensへの接続テスト ----------
 	$tokenTest = new OmiseTokensTest();
// 	$tokenTest->create();
// 	$tokenTest->retrieve();

	// ---------- Customersへの接続テスト ----------
 	$customerTest = new OmiseCustomersTest();
// 	$customerTest->listAll();
// 	$customerTest->create();
// 	$customerTest->retrieve();
// 	$customerTest->update();
// 	$customerTest->destroy();

 	// ---------- Cardsへの接続テスト ----------
 	$cardTest = new OmiseCardsTest();
// 	$cardTest->listAll();
//	$cardTest->retrieve();
//	$cardTest->update();
//	$cardTest->destroy();

 	// ---------- Chargesへの接続テスト ----------
 	$chargeTest = new OmiseChargesTest();
 	$chargeTest->listAll();
// 	$chargeTest->create();
} catch(OmiseException $e) {
	var_dump($e);
}

exit;
