<?php
require_once dirname(__FILE__).'/OmiseTest.php';
require_once dirname(__FILE__).'/../omise/Omise.php';
require_once dirname(__FILE__).'/../omise/model/OmiseList.php';
require_once dirname(__FILE__).'/../omise/model/OmiseCharge.php';
require_once dirname(__FILE__).'/../omise/model/OmiseChargeCreateInfo.php';
require_once dirname(__FILE__).'/../omise/model/OmiseChargeUpdateInfo.php';

class OmiseChargesTest extends OmiseTest {
	public function listAll() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		$omiseList = $omise->getOmiseAccessCharges()->listAll();
		
		echo('object:'.$omiseList->getObject()."\n");
		echo('from:'.$omiseList->getFrom()."\n");
		echo('to:'.$omiseList->getTo()."\n");
		echo('offset:'.$omiseList->getOffset()."\n");
		echo('limit:'.$omiseList->getLimit()."\n");
		echo('total:'.$omiseList->getTotal()."\n");
		foreach ($omiseList->getData() as $row) {
			echo('  data[object]:'.$row->getObject()."\n");
			echo('  data[id]:'.$row->getID()."\n");
			echo('  data[livemode]:'.$row->getLivemode()."\n");
			echo('  data[location]:'.$row->getLocation()."\n");
			echo('  data[amount]:'.$row->getAmount()."\n");
			echo('  data[currency]:'.$row->getCurrency()."\n");
			echo('  data[description]:'.$row->getDescription()."\n");
			echo('  data[capture]:'.$row->getCapture()."\n");
			echo('  data[authorized]:'.$row->getAuthorized()."\n");
			echo('  data[captured]:'.$row->getCaptured()."\n");
			echo('  data[transaction]:'.$row->getTransaction()."\n");
			echo('  data[failure_code]:'.$row->getFailureCode()."\n");
			echo('  data[failure_message]:'.$row->getFailureMessage()."\n");

			echo('    data[card][object]:'.$row->getCard()->getObject()."\n");
			echo('    data[card][id]:'.$row->getCard()->getID()."\n");
			echo('    data[card][livemode]:'.$row->getCard()->getLivemode()."\n");
			echo('    data[card][location]:'.$row->getCard()->getLocation()."\n");
			echo('    data[card][country]:'.$row->getCard()->getCountry()."\n");
			echo('    data[card][city]:'.$row->getCard()->getCity()."\n");
			echo('    data[card][postal_code]:'.$row->getCard()->getPostalCode()."\n");
			echo('    data[card][financing]:'.$row->getCard()->getFinancing()."\n");
			echo('    data[card][last_digits]:'.$row->getCard()->getLastDigits()."\n");
			echo('    data[card][brand]:'.$row->getCard()->getBrand()."\n");
			echo('    data[card][expiration_month]:'.$row->getCard()->getExpirationMonth()."\n");
			echo('    data[card][expiration_year]:'.$row->getCard()->getExpirationYear()."\n");
			echo('    data[card][fingerprint]:'.$row->getCard()->getFingerprint()."\n");
			echo('    data[card][name]:'.$row->getCard()->getName()."\n");
			echo('    data[card][security_code_check]:'.$row->getCard()->getSecurityCodeCheck()."\n");
			echo('    data[card][created]:'.$row->getCard()->getCreated()."\n");
			
			echo('  data[customer]:'.$row->getCustomer()."\n");
			echo('  data[ip]:'.$row->getIP()."\n");
			echo('  data[created]:'.$row->getCreated()."\n");
		}
	}
	
	public function create() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		
		$info = new OmiseChargeCreateInfo();
		$info->setCustomer(self::CUSTOMERID);
		$info->setCard(self::CARDID);
		//$info->setCard(self::TOKENID);
		$info->setAmount(100000);
		$info->setCurrency('thb');
		$info->setReturnUri('https://example.co.th/orders/384/complete');
		$info->setIP('127.0.0.1');
		$info->setDescription('description=Order-385"');
		
		$omiseCharge = $omise->getOmiseAccessCharges()->create($info);

		echo('object:'.$omiseCharge->getObject()."\n");
		echo('id:'.$omiseCharge->getID()."\n");
		echo('livemode:'.$omiseCharge->getLivemode()."\n");
		echo('location:'.$omiseCharge->getLocation()."\n");
		echo('amount:'.$omiseCharge->getAmount()."\n");
		echo('currency:'.$omiseCharge->getCurrency()."\n");
		echo('description:'.$omiseCharge->getDescription()."\n");
		echo('capture:'.$omiseCharge->getCapture()."\n");
		echo('authorized:'.$omiseCharge->getAuthorized()."\n");
		echo('captured:'.$omiseCharge->getCaptured()."\n");
		echo('transaction:'.$omiseCharge->getTransaction()."\n");
		echo('return_uri:'.$omiseCharge->getReturnURI()."\n");
		echo('reference:'.$omiseCharge->getReference()."\n");
		echo('authorize_uri:'.$omiseCharge->getAuthorizeURI()."\n");

		echo('  card[object]:'.$omiseCharge->getCard()->getObject()."\n");
		echo('  card[id]:'.$omiseCharge->getCard()->getID()."\n");
		echo('  card[livemode]:'.$omiseCharge->getCard()->getLivemode()."\n");
		echo('  card[country]:'.$omiseCharge->getCard()->getCountry()."\n");
		echo('  card[city]:'.$omiseCharge->getCard()->getCity()."\n");
		echo('  card[postal_code]:'.$omiseCharge->getCard()->getPostalCode()."\n");
		echo('  card[financing]:'.$omiseCharge->getCard()->getFinancing()."\n");
		echo('  card[last_digits]:'.$omiseCharge->getCard()->getLastDigits()."\n");
		echo('  card[brand]:'.$omiseCharge->getCard()->getBrand()."\n");
		echo('  card[expiration_month]:'.$omiseCharge->getCard()->getExpirationMonth()."\n");
		echo('  card[expiration_year]:'.$omiseCharge->getCard()->getExpirationYear()."\n");
		echo('  card[fingerprint]:'.$omiseCharge->getCard()->getFingerprint()."\n");
		echo('  card[name]:'.$omiseCharge->getCard()->getName()."\n");
		echo('  card[created]:'.$omiseCharge->getCard()->getCreated()."\n");
		
		echo('customer:'.$omiseCharge->getCustomer()."\n");
		echo('ip:'.$omiseCharge->getIP()."\n");
		echo('created:'.$omiseCharge->getCreated()."\n");
	}
	
	public function retrieve() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		
		$omiseCharge = $omise->getOmiseAccessCharges()->retrieve(parent::CHARGEID);
		
		echo('object:'.$omiseCharge->getObject()."\n");
		echo('id:'.$omiseCharge->getID()."\n");
		echo('livemode:'.$omiseCharge->getLivemode()."\n");
		echo('location:'.$omiseCharge->getLocation()."\n");
		echo('amount:'.$omiseCharge->getAmount()."\n");
		echo('currency:'.$omiseCharge->getCurrency()."\n");
		echo('description:'.$omiseCharge->getDescription()."\n");
		echo('capture:'.$omiseCharge->getCapture()."\n");
		echo('authorized:'.$omiseCharge->getAuthorized()."\n");
		echo('captured:'.$omiseCharge->getCaptured()."\n");
		echo('transaction:'.$omiseCharge->getTransaction()."\n");
		echo('return_uri:'.$omiseCharge->getReturnURI()."\n");
		echo('reference:'.$omiseCharge->getReference()."\n");
		echo('authorize_uri:'.$omiseCharge->getAuthorizeURI()."\n");
		
		echo('  card[object]:'.$omiseCharge->getCard()->getObject()."\n");
		echo('  card[id]:'.$omiseCharge->getCard()->getID()."\n");
		echo('  card[livemode]:'.$omiseCharge->getCard()->getLivemode()."\n");
		echo('  card[country]:'.$omiseCharge->getCard()->getCountry()."\n");
		echo('  card[city]:'.$omiseCharge->getCard()->getCity()."\n");
		echo('  card[postal_code]:'.$omiseCharge->getCard()->getPostalCode()."\n");
		echo('  card[financing]:'.$omiseCharge->getCard()->getFinancing()."\n");
		echo('  card[last_digits]:'.$omiseCharge->getCard()->getLastDigits()."\n");
		echo('  card[brand]:'.$omiseCharge->getCard()->getBrand()."\n");
		echo('  card[expiration_month]:'.$omiseCharge->getCard()->getExpirationMonth()."\n");
		echo('  card[expiration_year]:'.$omiseCharge->getCard()->getExpirationYear()."\n");
		echo('  card[fingerprint]:'.$omiseCharge->getCard()->getFingerprint()."\n");
		echo('  card[name]:'.$omiseCharge->getCard()->getName()."\n");
		echo('  card[created]:'.$omiseCharge->getCard()->getCreated()."\n");
		
		echo('customer:'.$omiseCharge->getCustomer()."\n");
		echo('ip:'.$omiseCharge->getIP()."\n");
		echo('created:'.$omiseCharge->getCreated()."\n");
	}
	
	public function update() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		
		$info = new OmiseChargeUpdateInfo();
		$info->setChargeID(parent::CHARGEID);
		$info->setDescription('Another description');
		
		$omiseCharge = $omise->getOmiseAccessCharges()->update($info);

		echo('object:'.$omiseCharge->getObject()."\n");
		echo('id:'.$omiseCharge->getID()."\n");
		echo('livemode:'.$omiseCharge->getLivemode()."\n");
		echo('location:'.$omiseCharge->getLocation()."\n");
		echo('amount:'.$omiseCharge->getAmount()."\n");
		echo('currency:'.$omiseCharge->getCurrency()."\n");
		echo('description:'.$omiseCharge->getDescription()."\n");
		echo('capture:'.$omiseCharge->getCapture()."\n");
		echo('authorized:'.$omiseCharge->getAuthorized()."\n");
		echo('captured:'.$omiseCharge->getCaptured()."\n");
		echo('transaction:'.$omiseCharge->getTransaction()."\n");
		echo('return_uri:'.$omiseCharge->getReturnURI()."\n");
		echo('reference:'.$omiseCharge->getReference()."\n");
		echo('authorize_uri:'.$omiseCharge->getAuthorizeURI()."\n");
		
		echo('  card[object]:'.$omiseCharge->getCard()->getObject()."\n");
		echo('  card[id]:'.$omiseCharge->getCard()->getID()."\n");
		echo('  card[livemode]:'.$omiseCharge->getCard()->getLivemode()."\n");
		echo('  card[country]:'.$omiseCharge->getCard()->getCountry()."\n");
		echo('  card[city]:'.$omiseCharge->getCard()->getCity()."\n");
		echo('  card[postal_code]:'.$omiseCharge->getCard()->getPostalCode()."\n");
		echo('  card[financing]:'.$omiseCharge->getCard()->getFinancing()."\n");
		echo('  card[last_digits]:'.$omiseCharge->getCard()->getLastDigits()."\n");
		echo('  card[brand]:'.$omiseCharge->getCard()->getBrand()."\n");
		echo('  card[expiration_month]:'.$omiseCharge->getCard()->getExpirationMonth()."\n");
		echo('  card[expiration_year]:'.$omiseCharge->getCard()->getExpirationYear()."\n");
		echo('  card[fingerprint]:'.$omiseCharge->getCard()->getFingerprint()."\n");
		echo('  card[name]:'.$omiseCharge->getCard()->getName()."\n");
		echo('  card[created]:'.$omiseCharge->getCard()->getCreated()."\n");
		
		echo('customer:'.$omiseCharge->getCustomer()."\n");
		echo('ip:'.$omiseCharge->getIP()."\n");
		echo('created:'.$omiseCharge->getCreated()."\n");
	}

	public function captureAnAuthorized() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
	
		$omiseCharge = $omise->getOmiseAccessCharges()->captureAnAuthorized(parent::CHARGEID);
	
		echo('object:'.$omiseCharge->getObject()."\n");
		echo('id:'.$omiseCharge->getID()."\n");
		echo('livemode:'.$omiseCharge->getLivemode()."\n");
		echo('location:'.$omiseCharge->getLocation()."\n");
		echo('amount:'.$omiseCharge->getAmount()."\n");
		echo('currency:'.$omiseCharge->getCurrency()."\n");
		echo('description:'.$omiseCharge->getDescription()."\n");
		echo('capture:'.$omiseCharge->getCapture()."\n");
		echo('authorized:'.$omiseCharge->getAuthorized()."\n");
		echo('captured:'.$omiseCharge->getCaptured()."\n");
		echo('transaction:'.$omiseCharge->getTransaction()."\n");
		echo('return_uri:'.$omiseCharge->getReturnURI()."\n");
		echo('reference:'.$omiseCharge->getReference()."\n");
		echo('authorize_uri:'.$omiseCharge->getAuthorizeURI()."\n");
	
		echo('  card[object]:'.$omiseCharge->getCard()->getObject()."\n");
		echo('  card[id]:'.$omiseCharge->getCard()->getID()."\n");
		echo('  card[livemode]:'.$omiseCharge->getCard()->getLivemode()."\n");
		echo('  card[country]:'.$omiseCharge->getCard()->getCountry()."\n");
		echo('  card[city]:'.$omiseCharge->getCard()->getCity()."\n");
		echo('  card[postal_code]:'.$omiseCharge->getCard()->getPostalCode()."\n");
		echo('  card[financing]:'.$omiseCharge->getCard()->getFinancing()."\n");
		echo('  card[last_digits]:'.$omiseCharge->getCard()->getLastDigits()."\n");
		echo('  card[brand]:'.$omiseCharge->getCard()->getBrand()."\n");
		echo('  card[expiration_month]:'.$omiseCharge->getCard()->getExpirationMonth()."\n");
		echo('  card[expiration_year]:'.$omiseCharge->getCard()->getExpirationYear()."\n");
		echo('  card[fingerprint]:'.$omiseCharge->getCard()->getFingerprint()."\n");
		echo('  card[name]:'.$omiseCharge->getCard()->getName()."\n");
		echo('  card[created]:'.$omiseCharge->getCard()->getCreated()."\n");
	
		echo('customer:'.$omiseCharge->getCustomer()."\n");
		echo('ip:'.$omiseCharge->getIP()."\n");
		echo('created:'.$omiseCharge->getCreated()."\n");
	}
}
