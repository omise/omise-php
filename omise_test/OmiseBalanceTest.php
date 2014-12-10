<?php
require_once dirname(__FILE__).'/OmiseTest.php';
require_once dirname(__FILE__).'/../omise/Omise.php';
require_once dirname(__FILE__).'/../omise/model/OmiseBalance.php';

class OmiseBalanceTest extends OmiseTest {
	public function retrieve() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		
		$omiseBalance = $omise->getOmiseAccessBalance()->retrieve();

		echo('object:'.$omiseBalance->getObject()."\n");
		echo('livemode:'.$omiseBalance->getLivemode()."\n");
		echo('available:'.$omiseBalance->getAvailable()."\n");
		echo('total:'.$omiseBalance->getTotal()."\n");
		echo('currency:'.$omiseBalance->getCurrency()."\n");
	}
}
