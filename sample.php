<?php
require_once dirname(__FILE__).'/omise/Omise.php';
require_once dirname(__FILE__).'/omise/model/OmiseCardCreateInfo.php';
require_once dirname(__FILE__).'/omise/model/OmiseTokenCreateInfo.php';
require_once dirname(__FILE__).'/omise/model/OmiseCardUpdateInfo.php';
require_once dirname(__FILE__).'/omise/model/OmiseChargeCreateInfo.php';

try {
	$omise = new Omise('skey_test_4y9cewl0rgwji2kbbcb', 'pkey_test_4y9cewl0s1osh44ouud');
	
// 	$info = new OmiseTokenCreateInfo();
// 	$info->setExpirationMonth(1);
// 	$info->setExpirationYear(2018);
// 	$info->setName('NAOKI MIHARA');
// 	$info->setNumber('4242424242424242');
// 	$info->setSecurityCode('432');
// 	$result = $omise->getOmiseAccessTokens()->create($info);
// 	var_dump($result);
	
// 	$info = new OmiseCardCreateInfo();
// 	$info->setCard($result->getID());
// 	$info->setDescription('description');
// 	$info->setEmail('naoki@alpha-do.com');
// 	$result = $omise->getOmiseAccessCards()->create($info);
// 	var_dump($result);
	
	var_dump($omise->getOmiseAccessCustomers()->listAll());
} catch(OmiseException $e) {
	var_dump($e);
}

exit;
?>