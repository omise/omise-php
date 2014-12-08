<?php
require_once dirname(__FILE__).'/omise/Omise.php';
require_once dirname(__FILE__).'/omise/model/OmiseCardCreateInfo.php';
require_once dirname(__FILE__).'/omise/model/OmiseTokenCreateInfo.php';

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
	
	$tokenCreateInfo = new OmiseTokenCreateInfo('Somchai Prasert', '4242424242424242', '10', '2018', '123', '10320', 'Bangkok');
	$omiseTokens = $omise->getOmiseAccessTokens()->create($tokenCreateInfo);
	
	$cardCreateInfo = new OmiseCardCreateInfo('John Doe (id: 30)', 'john.doe@example.com', $omiseTokens->getID());
	var_dump($omise->getOmiseAccessCards()->create($cardCreateInfo));
} catch(OmiseException $e) {
	var_dump($e);
}

exit;
?>