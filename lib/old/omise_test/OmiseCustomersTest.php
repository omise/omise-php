<?php
require_once dirname(__FILE__).'/OmiseTest.php';
require_once dirname(__FILE__).'/../omise/Omise.php';
require_once dirname(__FILE__).'/../omise/model/OmiseList.php';
require_once dirname(__FILE__).'/../omise/model/OmiseCustomer.php';
require_once dirname(__FILE__).'/../omise/model/OmiseCustomerCreateInfo.php';
require_once dirname(__FILE__).'/../omise/model/OmiseCustomerUpdateInfo.php';

class OmiseCustomersTest extends OmiseTest {
	public function listAll() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
	
		$omiseList = $omise->getOmiseAccessCustomers()->listAll();
		
		echo('object:'.$omiseList->getObject()."\n");
		echo('from:'.$omiseList->getFrom()."\n");
		echo('to:'.$omiseList->getTo()."\n");
		echo('offset:'.$omiseList->getOffset()."\n");
		echo('limit:'.$omiseList->getLimit()."\n");
		echo('total:'.$omiseList->getTotal()."\n");
		foreach ($omiseList->getData() as $row) {
			echo("  data[][object]:".$row->getObject()."\n");
			echo("  data[][id]:".$row->getID()."\n");
			echo("  data[][livemode]:".$row->getLivemode()."\n");
			echo("  data[][location]:".$row->getLocation()."\n");
			echo("  data[][default_card]:".$row->getDefaultCard()."\n");
			echo("  data[][email]:".$row->getEmail()."\n");
			echo("  data[][description]:".$row->getDescription()."\n");
			echo("  data[][created]:".$row->getCreated()."\n");
			echo("    data[cards][object]:".$row->getCards()->getObject()."\n");
			echo("    data[cards][from]:".$row->getCards()->getFrom()."\n");
			echo("    data[cards][to]:".$row->getCards()->getTo()."\n");
			echo("    data[cards][offset]:".$row->getCards()->getOffset()."\n");
			echo("    data[cards][limit]:".$row->getCards()->getLimit()."\n");
			echo("    data[cards][total]:".$row->getCards()->getTotal()."\n");
			foreach ($row->getCards()->getData() as $row2) {
				echo("      data[cards][data][][object]:".$row2->getObject()."\n");
				echo("      data[cards][data][][id]:".$row2->getID()."\n");
				echo("      data[cards][data][][livemode]:".$row2->getLivemode()."\n");
				echo("      data[cards][data][][location]:".$row2->getLocation()."\n");
				echo("      data[cards][data][][country]:".$row2->getCountry()."\n");
				echo("      data[cards][data][][city]:".$row2->getCity()."\n");
				echo("      data[cards][data][][postal_code]:".$row2->getPostalCode()."\n");
				echo("      data[cards][data][][financing]:".$row2->getFinancing()."\n");
				echo("      data[cards][data][][last_digits]:".$row2->getLastDigits()."\n");
				echo("      data[cards][data][][brand]:".$row2->getBrand()."\n");
				echo("      data[cards][data][][expiration_month]:".$row2->getExpirationMonth()."\n");
				echo("      data[cards][data][][expiration_year]:".$row2->getExpirationYear()."\n");
				echo("      data[cards][data][][fingerprint]:".$row2->getFingerprint()."\n");
				echo("      data[cards][data][][name]:".$row2->getName()."\n");
				echo("      data[cards][data][][security_code_check]:".$row2->getSecurityCodeCheck()."\n");
				echo("      data[cards][data][][created]:".$row2->getCreated()."\n");
			}
			echo("  data[][location]:".$row->getLocation()."\n");
		}
	}
	
	public function create() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		
		$info = new OmiseCustomerCreateInfo();
		$info->setDescription('description=John Doe (id: 30)');
		$info->setEmail('john.doe@example.com');
		$info->setCard(self::TOKENID);
		
		$omiseCustomer = $omise->getOmiseAccessCustomers()->create($info);

		echo('object:'.$omiseCustomer->getObject()."\n");
		echo('id:'.$omiseCustomer->getID()."\n");
		echo('livemode:'.$omiseCustomer->getLivemode()."\n");
		echo('location:'.$omiseCustomer->getLocation()."\n");
		echo('default_card:'.$omiseCustomer->getDefaultCard()."\n");
		echo('email:'.$omiseCustomer->getEmail()."\n");
		echo('description:'.$omiseCustomer->getDescription()."\n");
		echo('created:'.$omiseCustomer->getCreated()."\n");
		echo("  cards[object]".$omiseCustomer->getCards()->getObject()."\n");
		echo("  cards[from]".$omiseCustomer->getCards()->getFrom()."\n");
		echo("  cards[to]".$omiseCustomer->getCards()->getTo()."\n");
		echo("  cards[offset]".$omiseCustomer->getCards()->getOffset()."\n");
		echo("  cards[limit]".$omiseCustomer->getCards()->getLimit()."\n");
		echo("  cards[total]".$omiseCustomer->getCards()->getTotal()."\n");
		foreach ($omiseCustomer->getCards()->getData() as $row) {
			echo("    cards[data][][object]".$row->getObject()."\n");
			echo("    cards[data][][id]".$row->getID()."\n");
			echo("    cards[data][][livemode]".$row->getLivemode()."\n");
			echo("    cards[data][][location]".$row->getLocation()."\n");
			echo("    cards[data][][country]".$row->getCountry()."\n");
			echo("    cards[data][][city]".$row->getCity()."\n");
			echo("    cards[data][][postal_code]".$row->getPostalCode()."\n");
			echo("    cards[data][][financing]".$row->getFinancing()."\n");
			echo("    cards[data][][last_digits]".$row->getLastDigits()."\n");
			echo("    cards[data][][brand]".$row->getBrand()."\n");
			echo("    cards[data][][expiration_month]".$row->getExpirationMonth()."\n");
			echo("    cards[data][][expiration_year]".$row->getExpirationYear()."\n");
			echo("    cards[data][][fingerprint]".$row->getFingerprint()."\n");
			echo("    cards[data][][name]".$row->getName()."\n");
			echo("    cards[data][][created]".$row->getCreated()."\n");
		}
		echo("  cards[location]".$omiseCustomer->getCards()->getLocation()."\n");
	}
	
	public function retrieve() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		$omiseCustomer = $omise->getOmiseAccessCustomers()->retrieve(parent::CUSTOMERID);

		echo('object:'.$omiseCustomer->getObject()."\n");
		echo('id:'.$omiseCustomer->getID()."\n");
		echo('livemode:'.$omiseCustomer->getLivemode()."\n");
		echo('location:'.$omiseCustomer->getLocation()."\n");
		echo('default_card:'.$omiseCustomer->getDefaultCard()."\n");
		echo('email:'.$omiseCustomer->getEmail()."\n");
		echo('description:'.$omiseCustomer->getDescription()."\n");
		echo('created:'.$omiseCustomer->getCreated()."\n");
		echo("  cards[object]".$omiseCustomer->getCards()->getObject()."\n");
		echo("  cards[from]".$omiseCustomer->getCards()->getFrom()."\n");
		echo("  cards[to]".$omiseCustomer->getCards()->getTo()."\n");
		echo("  cards[offset]".$omiseCustomer->getCards()->getOffset()."\n");
		echo("  cards[limit]".$omiseCustomer->getCards()->getLimit()."\n");
		echo("  cards[total]".$omiseCustomer->getCards()->getTotal()."\n");
		foreach ($omiseCustomer->getCards()->getData() as $row) {
			echo("    cards[data][][object]".$row->getObject()."\n");
			echo("    cards[data][][id]".$row->getID()."\n");
			echo("    cards[data][][livemode]".$row->getLivemode()."\n");
			echo("    cards[data][][location]".$row->getLocation()."\n");
			echo("    cards[data][][country]".$row->getCountry()."\n");
			echo("    cards[data][][city]".$row->getCity()."\n");
			echo("    cards[data][][postal_code]".$row->getPostalCode()."\n");
			echo("    cards[data][][financing]".$row->getFinancing()."\n");
			echo("    cards[data][][last_digits]".$row->getLastDigits()."\n");
			echo("    cards[data][][brand]".$row->getBrand()."\n");
			echo("    cards[data][][expiration_month]".$row->getExpirationMonth()."\n");
			echo("    cards[data][][expiration_year]".$row->getExpirationYear()."\n");
			echo("    cards[data][][fingerprint]".$row->getFingerprint()."\n");
			echo("    cards[data][][name]".$row->getName()."\n");
			echo("    cards[data][][created]".$row->getCreated()."\n");
		}
		echo("  cards[location]".$omiseCustomer->getCards()->getLocation()."\n");
	}
	
	public function update() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		
		$info = new OmiseCustomerUpdateInfo();
		$info->setCustomerID(parent::CUSTOMERID);
		$info->setCard(parent::TOKENID);
		$info->setEmail('john.smith@example.com');
		$info->setDescription('Another description');
		
		$omiseCustomer = $omise->getOmiseAccessCustomers()->update($info);

		echo('object:'.$omiseCustomer->getObject()."\n");
		echo('id:'.$omiseCustomer->getID()."\n");
		echo('livemode:'.$omiseCustomer->getLivemode()."\n");
		echo('location:'.$omiseCustomer->getLocation()."\n");
		echo('default_card:'.$omiseCustomer->getDefaultCard()."\n");
		echo('email:'.$omiseCustomer->getEmail()."\n");
		echo('description:'.$omiseCustomer->getDescription()."\n");
		echo('created:'.$omiseCustomer->getCreated()."\n");
		echo("  cards[object]".$omiseCustomer->getCards()->getObject()."\n");
		echo("  cards[from]".$omiseCustomer->getCards()->getFrom()."\n");
		echo("  cards[to]".$omiseCustomer->getCards()->getTo()."\n");
		echo("  cards[offset]".$omiseCustomer->getCards()->getOffset()."\n");
		echo("  cards[limit]".$omiseCustomer->getCards()->getLimit()."\n");
		echo("  cards[total]".$omiseCustomer->getCards()->getTotal()."\n");
		foreach ($omiseCustomer->getCards()->getData() as $row) {
			echo("    cards[data][][object]".$row->getObject()."\n");
			echo("    cards[data][][id]".$row->getID()."\n");
			echo("    cards[data][][livemode]".$row->getLivemode()."\n");
			echo("    cards[data][][location]".$row->getLocation()."\n");
			echo("    cards[data][][country]".$row->getCountry()."\n");
			echo("    cards[data][][city]".$row->getCity()."\n");
			echo("    cards[data][][postal_code]".$row->getPostalCode()."\n");
			echo("    cards[data][][financing]".$row->getFinancing()."\n");
			echo("    cards[data][][last_digits]".$row->getLastDigits()."\n");
			echo("    cards[data][][brand]".$row->getBrand()."\n");
			echo("    cards[data][][expiration_month]".$row->getExpirationMonth()."\n");
			echo("    cards[data][][expiration_year]".$row->getExpirationYear()."\n");
			echo("    cards[data][][fingerprint]".$row->getFingerprint()."\n");
			echo("    cards[data][][name]".$row->getName()."\n");
			echo("    cards[data][][created]".$row->getCreated()."\n");
		}
		echo("  cards[location]".$omiseCustomer->getCards()->getLocation()."\n");
	}
	
	public function destroy() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		
		$omiseCustomer = $omise->getOmiseAccessCustomers()->destroy(parent::CUSTOMERID);

		echo('object:'.$omiseCustomer->getObject()."\n");
		echo('id:'.$omiseCustomer->getID()."\n");
		echo('livemode:'.$omiseCustomer->getLivemode()."\n");
		echo('deleted:'.$omiseCustomer->getDeleted()."\n");
	}
}