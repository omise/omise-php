<?php
require_once dirname(__FILE__).'/OmiseTest.php';
require_once dirname(__FILE__).'/../omise/Omise.php';
require_once dirname(__FILE__).'/../omise/model/OmiseList.php';
require_once dirname(__FILE__).'/../omise/model/OmiseCard.php';
require_once dirname(__FILE__).'/../omise/model/OmiseCardUpdateInfo.php';

class OmiseCardsTest extends OmiseTest {
	public function listAll() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		$omiseList = $omise->getOmiseAccessCards()->listAll(parent::CUSTOMERID);
		
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
			echo('  data[country]:'.$row->getCountry()."\n");
			echo('  data[city]:'.$row->getCity()."\n");
			echo('  data[postal_code]:'.$row->getPostalCode()."\n");
			echo('  data[financing]:'.$row->getFinancing()."\n");
			echo('  data[last_digits]:'.$row->getLastDigits()."\n");
			echo('  data[brand]:'.$row->getBrand()."\n");
			echo('  data[expiration_month]:'.$row->getExpirationMonth()."\n");
			echo('  data[expiration_year]:'.$row->getExpirationYear()."\n");
			echo('  data[fingerprint]:'.$row->getFingerprint()."\n");
			echo('  data[name]:'.$row->getName()."\n");
			echo('  data[created]:'.$row->getCreated()."\n");
		}
	}
	
	public function retrieve() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		$omiseCard = $omise->getOmiseAccessCards()->retrieve(parent::CUSTOMERID, parent::CARDID);

		echo('object:'.$omiseCard->getObject()."\n");
		echo('id:'.$omiseCard->getID()."\n");
		echo('livemode:'.$omiseCard->getLivemode()."\n");
		echo('location:'.$omiseCard->getLocation()."\n");
		echo('country:'.$omiseCard->getCountry()."\n");
		echo('city:'.$omiseCard->getCity()."\n");
		echo('postal_code:'.$omiseCard->getPostalCode()."\n");
		echo('financing:'.$omiseCard->getFinancing()."\n");
		echo('last_digits:'.$omiseCard->getLastDigits()."\n");
		echo('brand:'.$omiseCard->getBrand()."\n");
		echo('expiration_month:'.$omiseCard->getExpirationMonth()."\n");
		echo('expiration_year:'.$omiseCard->getExpirationYear()."\n");
		echo('fingerprint:'.$omiseCard->getFingerprint()."\n");
		echo('name:'.$omiseCard->getName()."\n");
		echo('created:'.$omiseCard->getCreated()."\n");
	}
	
	public function update() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		
		$info = new OmiseCardUpdateInfo();
		$info->setCardID(parent::CARDID);
		$info->setCustomerID(parent::CUSTOMERID);
		$info->setName('Somchai Praset');
		$info->setCity('Bangkok');
		$info->setExpirationMonth(11);
		$info->setExpirationYear(2017);
		$info->setPostalCode(10310);
		
		$omiseCard = $omise->getOmiseAccessCards()->update($info);

		echo('object:'.$omiseCard->getObject()."\n");
		echo('id:'.$omiseCard->getID()."\n");
		echo('livemode:'.$omiseCard->getLivemode()."\n");
		echo('location:'.$omiseCard->getLocation()."\n");
		echo('country:'.$omiseCard->getCountry()."\n");
		echo('city:'.$omiseCard->getCity()."\n");
		echo('postal_code:'.$omiseCard->getPostalCode()."\n");
		echo('financing:'.$omiseCard->getFinancing()."\n");
		echo('last_digits:'.$omiseCard->getLastDigits()."\n");
		echo('brand:'.$omiseCard->getBrand()."\n");
		echo('expiration_month:'.$omiseCard->getExpirationMonth()."\n");
		echo('expiration_year:'.$omiseCard->getExpirationYear()."\n");
		echo('fingerprint:'.$omiseCard->getFingerprint()."\n");
		echo('name:'.$omiseCard->getName()."\n");
		echo('created:'.$omiseCard->getCreated()."\n");
	}
	
	public function destroy() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		$omiseCard = $omise->getOmiseAccessCards()->destroy(parent::CUSTOMERID, parent::CARDID);
		
		echo('object:'.$omiseCard->getObject()."\n");
		echo('id:'.$omiseCard->getID()."\n");
		echo('livemode:'.$omiseCard->getLivemode()."\n");
		echo('deleted:'.$omiseCard->getDeleted()."\n");
	}
}
