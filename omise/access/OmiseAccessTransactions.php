<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';
require_once dirname(__FILE__).'/../model/OmiseList.php';
require_once dirname(__FILE__).'/../model/OmiseTransaction.php';

class OmiseAccessTransactions extends OmiseAccessBase {
	/**
	 * トランザクションのリストを取得する
	 * @return OmiseList
	 */
	public function listAll() {
		$array = parent::execute(parent::URLBASE_API.'/transactions', parent::REQUEST_GET, $this->_secretkey);
		
		return new OmiseList($array);
	}
	
	public function retrieve($transactionID) {
		$array = parent::execute(parent::URLBASE_API.'/transactions/'.$transactionID, parent::REQUEST_GET, $this->_secretkey);
		
		return new OmiseTransaction($array);
	}
}
?>