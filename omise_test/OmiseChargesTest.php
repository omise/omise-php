<?php
require_once dirname(__FILE__).'/OmiseTest.php';
require_once dirname(__FILE__).'/../omise/Omise.php';
require_once dirname(__FILE__).'/../omise/model/OmiseList.php';
require_once dirname(__FILE__).'/../omise/model/OmiseCharge.php';

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
}
