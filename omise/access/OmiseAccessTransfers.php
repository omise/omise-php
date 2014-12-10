<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';
require_once dirname(__FILE__).'/../model/OmiseList.php';
require_once dirname(__FILE__).'/../model/OmiseTransfer.php';

class OmiseAccessTransfers extends OmiseAccessBase {
	const PARAM_AMOUNT = 'amount';
	
	/**
	 * トランスファーのリストを取得する
	 * @return OmiseTransfer
	 */
	public function listAll() {
		$array = parent::execute(parent::URLBASE_VAULT.'/transfers', parent::REQUEST_GET, $this->_secretkey);
		
		return new OmiseList($array);
	}
	
	/**
	 * トランスファーを作成する
	 * @param integer $amount
	 * @return OmiseTransfer
	 */
	public function create($amount) {
		$param = array(self::PARAM_AMOUNT => $amount);
		$array = parent::execute(parent::URLBASE_VAULT.'/transfers', parent::REQUEST_POST, $this->_secretkey, $param);
		
		return new OmiseTransfer($array);
	}
}