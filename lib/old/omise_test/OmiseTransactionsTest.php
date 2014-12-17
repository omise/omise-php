<?php
require_once dirname(__FILE__).'/OmiseTest.php';
require_once dirname(__FILE__).'/../omise/Omise.php';
require_once dirname(__FILE__).'/../omise/model/OmiseList.php';
require_once dirname(__FILE__).'/../omise/model/OmiseTransaction.php';

class OmiseTransactionsTest extends OmiseTest {
	public function listAll() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		$omiseList = $omise->getOmiseAccessTransactions()->listAll();
		
		echo('object:'.$omiseList->getObject()."\n");
		echo('from:'.$omiseList->getFrom()."\n");
		echo('to:'.$omiseList->getTo()."\n");
		echo('offset:'.$omiseList->getOffset()."\n");
		echo('limit:'.$omiseList->getLimit()."\n");
		echo('total:'.$omiseList->getTotal()."\n");
		foreach ($omiseList->getData() as $row) {
			echo('  data[object]:'.$row->getObject()."\n");
			echo('  data[id]:'.$row->getID()."\n");
			echo('  data[type]:'.$row->getType()."\n");
			echo('  data[amount]:'.$row->getAmount()."\n");
			echo('  data[currency]:'.$row->getCurrency()."\n");
			echo('  data[created]:'.$row->getCreated()."\n");
		}
	}
	
	public function retrieve() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		$omiseTransaction = $omise->getOmiseAccessTransactions()->retrieve(parent::TRANSACTIONID);

		echo('object:'.$omiseTransaction->getObject()."\n");
		echo('id:'.$omiseTransaction->getID()."\n");
		echo('type:'.$omiseTransaction->getType()."\n");
		echo('amount:'.$omiseTransaction->getAmount()."\n");
		echo('currency:'.$omiseTransaction->getCurrency()."\n");
		echo('created:'.$omiseTransaction->getCreated()."\n");
	}
}
