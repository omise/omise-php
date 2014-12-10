<?php
require_once dirname(__FILE__).'/OmiseTest.php';
require_once dirname(__FILE__).'/../omise/Omise.php';
require_once dirname(__FILE__).'/../omise/model/OmiseAccount.php';

class OmiseAccountTest extends OmiseTest {
	public function retrieve() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		
		$omiseAccount = $omise->getOmiseAccessAccount()->retrieve();

		echo('object:'.$omiseAccount->getObject()."\n");
		echo('id:'.$omiseAccount->getID()."\n");
		echo('email:'.$omiseAccount->getEmail()."\n");
		echo('created:'.$omiseAccount->getCreated()."\n");
	}
}
