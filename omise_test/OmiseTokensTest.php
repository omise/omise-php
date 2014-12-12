<?php
require_once dirname(__FILE__).'/OmiseTest.php';
require_once dirname(__FILE__).'/../omise/Omise.php';
require_once dirname(__FILE__).'/../omise/model/OmiseTokenCreateInfo.php';
require_once dirname(__FILE__).'/../omise/model/OmiseToken.php';
require_once dirname(__FILE__).'/../omise/model/OmiseCard.php';

class OmiseTokensTest extends OmiseTest {
	public function create() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		
		$info = new OmiseTokenCreateInfo();
		$info->setName('Somchai Prasert');
		$info->setNumber('4242424242424242');
		$info->setExpirationMonth(1);
		$info->setExpirationYear(2018);
		$info->setCity('Bangkok');
		$info->setPostalCode('10320');
		
		$omiseTokens = $omise->getOmiseAccessTokens()->create($info);
		
		echo('object:'.$omiseTokens->getObject()."\n");
		echo('id:'.$omiseTokens->getID()."\n");
		echo('livemode:'.$omiseTokens->getLivemode()."\n");
		echo('location:'.$omiseTokens->getLocation()."\n");
		echo('used:'.$omiseTokens->getUsed()."\n");
		echo("  card['object']:".$omiseTokens->getCard()->getObject()."\n");
		echo("  card['id']:".$omiseTokens->getCard()->getID()."\n");
		echo("  card['livemode']:".$omiseTokens->getCard()->getLivemode()."\n");
		echo("  card['country']:".$omiseTokens->getCard()->getCountry()."\n");
		echo("  card['city']:".$omiseTokens->getCard()->getCity()."\n");
		echo("  card['postal_code']:".$omiseTokens->getCard()->getPostalCode()."\n");
		echo("  card['financing']:".$omiseTokens->getCard()->getFinancing()."\n");
		echo("  card['last_digits']:".$omiseTokens->getCard()->getLastDigits()."\n");
		echo("  card['brand']:".$omiseTokens->getCard()->getBrand()."\n");
		echo("  card['expiration_month']:".$omiseTokens->getCard()->getExpirationMonth()."\n");
		echo("  card['expiration_year']:".$omiseTokens->getCard()->getExpirationYear()."\n");
		echo("  card['fingerprint']:".$omiseTokens->getCard()->getFingerprint()."\n");
		echo("  card['name']:".$omiseTokens->getCard()->getName()."\n");
		echo("  card['created']:".$omiseTokens->getCard()->getCreated()."\n");
		echo('created:'.$omiseTokens->getCreated()."\n");
	}
	
	public function retrieve() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		
		$omiseTokens = $omise->getOmiseAccessTokens()->retrieve(parent::TOKENID);

		echo('object:'.$omiseTokens->getObject()."\n");
		echo('id:'.$omiseTokens->getID()."\n");
		echo('livemode:'.$omiseTokens->getLivemode()."\n");
		echo('location:'.$omiseTokens->getLocation()."\n");
		echo('used:'.$omiseTokens->getUsed()."\n");
		echo("  card['object']:".$omiseTokens->getCard()->getObject()."\n");
		echo("  card['id']:".$omiseTokens->getCard()->getID()."\n");
		echo("  card['livemode']:".$omiseTokens->getCard()->getLivemode()."\n");
		echo("  card['country']:".$omiseTokens->getCard()->getCountry()."\n");
		echo("  card['city']:".$omiseTokens->getCard()->getCity()."\n");
		echo("  card['postal_code']:".$omiseTokens->getCard()->getPostalCode()."\n");
		echo("  card['financing']:".$omiseTokens->getCard()->getFinancing()."\n");
		echo("  card['last_digits']:".$omiseTokens->getCard()->getLastDigits()."\n");
		echo("  card['brand']:".$omiseTokens->getCard()->getBrand()."\n");
		echo("  card['expiration_month']:".$omiseTokens->getCard()->getExpirationMonth()."\n");
		echo("  card['expiration_year']:".$omiseTokens->getCard()->getExpirationYear()."\n");
		echo("  card['fingerprint']:".$omiseTokens->getCard()->getFingerprint()."\n");
		echo("  card['name']:".$omiseTokens->getCard()->getName()."\n");
		echo("  card['created']:".$omiseTokens->getCard()->getCreated()."\n");
		echo('created:'.$omiseTokens->getCreated()."\n");
	}
}
