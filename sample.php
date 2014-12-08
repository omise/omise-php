<?php
require_once dirname(__FILE__).'/omise/Omise.php';
require_once dirname(__FILE__).'/omise/model/OmiseCardCreateInfo.php';

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
	
// 	$cardCreateInfo = new OmiseCardCreateInfo('Somchai Prasert', '4242424242424242', '10', '2018', '123', '10320', 'Bangkok');
// 	$omiseTokens = $omise->getOmiseAccessTokens()->create($cardCreateInfo);
// 	echo("object:".$omiseTokens->getObject()."\n");
// 	echo("id:".$omiseTokens->getID()."\n");
// 	echo("livemode:".$omiseTokens->getLivemode()."\n");
// 	echo("location:".$omiseTokens->getLocation()."\n");
// 	echo("used:".$omiseTokens->getUsed()."\n");
// 	echo("card[object]:".$omiseTokens->getCard()->getObject()."\n");
// 	echo("card[id]:".$omiseTokens->getCard()->getID()."\n");
// 	echo("card[livemode]:".$omiseTokens->getCard()->getLivemode()."\n");
// 	echo("card[country]:".$omiseTokens->getCard()->getCountry()."\n");
// 	echo("card[city]:".$omiseTokens->getCard()->getCity()."\n");
// 	echo("card[postal_code]:".$omiseTokens->getCard()->getPostalCode()."\n");
// 	echo("card[financing]:".$omiseTokens->getCard()->getFinancing()."\n");
// 	echo("card[last_digits]:".$omiseTokens->getCard()->getLastDigits()."\n");
// 	echo("card[brand]:".$omiseTokens->getCard()->getBrand()."\n");
// 	echo("card[expiration_month]:".$omiseTokens->getCard()->getExpirationMonth()."\n");
// 	echo("card[expiration_year]:".$omiseTokens->getCard()->getExpirationYear()."\n");
// 	echo("card[fingerprint]:".$omiseTokens->getCard()->getFingerprint()."\n");
// 	echo("card[name]:".$omiseTokens->getCard()->getName()."\n");
// 	echo("card[created]:".$omiseTokens->getCard()->getCreated()."\n");
// 	echo("created:".$omiseTokens->getCreated()."\n");
// 	var_dump($omiseTokens);

	$omiseTokens = $omise->getOmiseAccessTokens()->retrieve('tokn_test_4ybagptsw8m0bqogzhk');
	echo("object:".$omiseTokens->getObject()."\n");
	echo("id:".$omiseTokens->getID()."\n");
	echo("livemode:".$omiseTokens->getLivemode()."\n");
	echo("location:".$omiseTokens->getLocation()."\n");
	echo("used:".$omiseTokens->getUsed()."\n");
	echo("card[object]:".$omiseTokens->getCard()->getObject()."\n");
	echo("card[id]:".$omiseTokens->getCard()->getID()."\n");
	echo("card[livemode]:".$omiseTokens->getCard()->getLivemode()."\n");
	echo("card[country]:".$omiseTokens->getCard()->getCountry()."\n");
	echo("card[city]:".$omiseTokens->getCard()->getCity()."\n");
	echo("card[postal_code]:".$omiseTokens->getCard()->getPostalCode()."\n");
	echo("card[financing]:".$omiseTokens->getCard()->getFinancing()."\n");
	echo("card[last_digits]:".$omiseTokens->getCard()->getLastDigits()."\n");
	echo("card[brand]:".$omiseTokens->getCard()->getBrand()."\n");
	echo("card[expiration_month]:".$omiseTokens->getCard()->getExpirationMonth()."\n");
	echo("card[expiration_year]:".$omiseTokens->getCard()->getExpirationYear()."\n");
	echo("card[fingerprint]:".$omiseTokens->getCard()->getFingerprint()."\n");
	echo("card[name]:".$omiseTokens->getCard()->getName()."\n");
	echo("card[created]:".$omiseTokens->getCard()->getCreated()."\n");
	echo("created:".$omiseTokens->getCreated()."\n");
	var_dump($omiseTokens);
	
} catch(OmiseException $e) {
	var_dump($e);
}

exit;
?>