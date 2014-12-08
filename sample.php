<?php
require_once dirname(__FILE__).'/omise/Omise.php';
require_once dirname(__FILE__).'/omise/model/OmiseCardCreateInfo.php';
require_once dirname(__FILE__).'/omise/model/OmiseTokenCreateInfo.php';
require_once dirname(__FILE__).'/omise/model/OmiseCardUpdateInfo.php';
require_once dirname(__FILE__).'/omise/model/OmiseChargeCreateInfo.php';

try {
	$omise = new Omise('skey_test_4y9cewl0rgwji2kbbcb', 'pkey_test_4y9cewl0s1osh44ouud');
	
// 	$omiseAccount = $omise->getOmiseAccessAccount()->retrieve();
// 	echo("object:".$omiseAccount->getObject()."\n");
// 	echo("id:".$omiseAccount->getID()."\n");
// 	echo("email:".$omiseAccount->getEmail()."\n");
// 	echo("created:".$omiseAccount->getCreated()."\n");
// 	var_dump($omiseAccount);
	
// 	$omiseBalance = $omise->getOmiseAccessBalance()->retrieve();
// 	echo("object:".$omiseBalance->getObject()."\n");
// 	echo("livemode:".$omiseBalance->getLivemode()."\n");
// 	echo("available:".$omiseBalance->getAvailable()."\n");
// 	echo("total:".$omiseBalance->getTotal()."\n");
// 	echo("currency:".$omiseBalance->getCurrency()."\n");
// 	var_dump($omiseBalance);
	
	$info = new OmiseChargeCreateInfo();
	$info->setReturnUri("https://example.co.th/orders/384/complete");
	$info->setAmount(100000);
	$info->setCurrency("thb");
	$info->setDescription("Order-384");
	$info->setIP("127.0.0.1");
	$info->setCapture("tokn_test_4xs9408a642a1htto8z");
	
	var_dump($omise->getOmiseAccessCharges()->create($info));
} catch(OmiseException $e) {
	var_dump($e);
}

exit;
?>