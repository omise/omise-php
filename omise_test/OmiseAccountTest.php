<?php
require_once dirname(__FILE__).'/OmiseTest.php';
require_once dirname(__FILE__).'/../omise/Omise.php';

class OmiseAccountTest extends OmiseTest {
	public function retrieve() {
		$omise = new Omise($this->_secretkey, $this->_publickey);
		
		$omiseAccessAccount = $omise->getOmiseAccessAccount()->retrieve();

		echo('object:'.$omiseAccessAccount->getObject()."\n");
		echo('id:'.$omiseAccessAccount->getID()."\n");
		echo('email:'.$omiseAccessAccount->getEmail()."\n");
		echo('created:'.$omiseAccessAccount->getCreated()."\n");
	}
}
