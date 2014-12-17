<?php
require_once dirname(__FILE__).'/OmiseTest.php';
require_once dirname(__FILE__).'/../omise/Omise.php';
require_once dirname(__FILE__).'/../omise/model/OmiseList.php';
require_once dirname(__FILE__).'/../omise/model/OmiseTransferCreateInfo.php';

class OmiseTransfersTest extends OmiseTest {
	public function listAll() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		$omiseList = $omise->getOmiseAccessTransfers()->listAll();
		
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
			echo('  data[sent]:'.$row->getSent()."\n");
			echo('  data[paid]:'.$row->getPaid()."\n");
			echo('  data[amount]:'.$row->getAmount()."\n");
			echo('  data[currency]:'.$row->getCurrency()."\n");
			echo('  data[failure_code]:'.$row->getFailureCode()."\n");
			echo('  data[failure_message]:'.$row->getFailureMessage()."\n");
			echo('  data[transaction]:'.$row->getTransaction()."\n");
			echo('  data[created]:'.$row->getCreated()."\n");
		}
	}
	
	public function create() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		
		$info = new OmiseTransferCreateInfo();
		$info->setAmount(10000);
		
		$omiseTransfer = $omise->getOmiseAccessTransfers()->create($info);

		echo('object:'.$omiseTransfer->getObject()."\n");
		echo('id:'.$omiseTransfer->getID()."\n");
		echo('livemode:'.$omiseTransfer->getLivemode()."\n");
		echo('location:'.$omiseTransfer->getLocation()."\n");
		echo('sent:'.$omiseTransfer->getSent()."\n");
		echo('paid:'.$omiseTransfer->getPaid()."\n");
		echo('amount:'.$omiseTransfer->getAmount()."\n");
		echo('currency:'.$omiseTransfer->getCurrency()."\n");
		echo('failure_code:'.$omiseTransfer->getFailureCode()."\n");
		echo('failure_message:'.$omiseTransfer->getFailureMessage()."\n");
		echo('transaction:'.$omiseTransfer->getTransaction()."\n");
		echo('created:'.$omiseTransfer->getCreated()."\n");
	}

	public function retrieve() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
	
		$omiseTransfer = $omise->getOmiseAccessTransfers()->retrieve(parent::TRANSFERID);
	
		echo('object:'.$omiseTransfer->getObject()."\n");
		echo('id:'.$omiseTransfer->getID()."\n");
		echo('livemode:'.$omiseTransfer->getLivemode()."\n");
		echo('location:'.$omiseTransfer->getLocation()."\n");
		echo('sent:'.$omiseTransfer->getSent()."\n");
		echo('paid:'.$omiseTransfer->getPaid()."\n");
		echo('amount:'.$omiseTransfer->getAmount()."\n");
		echo('currency:'.$omiseTransfer->getCurrency()."\n");
		echo('failure_code:'.$omiseTransfer->getFailureCode()."\n");
		echo('failure_message:'.$omiseTransfer->getFailureMessage()."\n");
		echo('transaction:'.$omiseTransfer->getTransaction()."\n");
		echo('created:'.$omiseTransfer->getCreated()."\n");
	}
	
	public function update() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		
		$info = new OmiseTransferUpdateInfo();
		$info->setAmount(10000);
		$info->setTransferID(parent::TRANSFERID);
		
		$omiseTransfer = $omise->getOmiseAccessTransfers()->update($info);
	
		echo('object:'.$omiseTransfer->getObject()."\n");
		echo('id:'.$omiseTransfer->getID()."\n");
		echo('livemode:'.$omiseTransfer->getLivemode()."\n");
		echo('location:'.$omiseTransfer->getLocation()."\n");
		echo('sent:'.$omiseTransfer->getSent()."\n");
		echo('paid:'.$omiseTransfer->getPaid()."\n");
		echo('amount:'.$omiseTransfer->getAmount()."\n");
		echo('currency:'.$omiseTransfer->getCurrency()."\n");
		echo('failure_code:'.$omiseTransfer->getFailureCode()."\n");
		echo('failure_message:'.$omiseTransfer->getFailureMessage()."\n");
		echo('transaction:'.$omiseTransfer->getTransaction()."\n");
		echo('created:'.$omiseTransfer->getCreated()."\n");
	}
	
	public function destroy() {
		$omise = new Omise(parent::PUBLICKEY, parent::SECRETKEY);
		
		$omiseTransfer = $omise->getOmiseAccessTransfers()->destroy(parent::TRANSFERID);

		echo('object:'.$omiseTransfer->getObject()."\n");
		echo('id:'.$omiseTransfer->getID()."\n");
		echo('livemode:'.$omiseTransfer->getLivemode()."\n");
		echo('deleted:'.$omiseTransfer->getDeleted()."\n");
		
	}
}
