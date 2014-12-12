<?php
require_once dirname(__FILE__).'/OmiseTest.php';
require_once dirname(__FILE__).'/../omise/Omise.php';
require_once dirname(__FILE__).'/../omise/model/OmiseList.php';

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
			echo("    cards[object]:".$row->getCards()->getObject()."\n");
			echo("    cards[from]:".$row->getCards()->getFrom()."\n");
			echo("    cards[to]:".$row->getCards()->getTo()."\n");
			echo("    cards[offset]:".$row->getCards()->getOffset()."\n");
			echo("    cards[limit]:".$row->getCards()->getLimit()."\n");
			echo("    cards[total]:".$row->getCards()->getTotal()."\n");
			foreach ($row->getCards()->getData() as $row2) {
				echo("      data[][object]:".$row2->getObject()."\n");
				echo("      data[][id]:".$row2->getID()."\n");
				echo("      data[][livemode]:".$row2->getLivemode()."\n");
				echo("      data[][location]:".$row2->getLocation()."\n");
				echo("      data[][country]:".$row2->getCountry()."\n");
				echo("      data[][city]:".$row2->getCity()."\n");
				echo("      data[][postal_code]:".$row2->getPostalCode()."\n");
				echo("      data[][financing]:".$row2->getFinancing()."\n");
				echo("      data[][last_digits]:".$row2->getLastDigits()."\n");
				echo("      data[][brand]:".$row2->getBrand()."\n");
				echo("      data[][expiration_month]:".$row2->getExpirationMonth()."\n");
				echo("      data[][expiration_year]:".$row2->getExpirationYear()."\n");
				echo("      data[][fingerprint]:".$row2->getFingerprint()."\n");
				echo("      data[][name]:".$row2->getName()."\n");
				echo("      data[][security_code_check]:".$row2->getSecurityCodeCheck()."\n");
				echo("      data[][created]:".$row2->getCreated()."\n");
			}
			echo("  data[][location]:".$row->getLocation()."\n");
		}
	}
}