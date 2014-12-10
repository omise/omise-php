<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';
require_once dirname(__FILE__).'/../model/OmiseList.php';
require_once dirname(__FILE__).'/../model/OmiseTransfer.php';
require_once dirname(__FILE__).'/../model/OmiseTransferCreateInfo.php';
require_once dirname(__FILE__).'/../model/OmiseTransferUpdateInfo.php';

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
	 * @param OmiseTransferCreateInfo $transferCreateInfo
	 * @return OmiseTransfer
	 */
	public function create($transferCreateInfo) {
		$param = array();
		if($transferCreateInfo->getAmouont() !== null) $array += array(self::PARAM_AMOUNT => $transferCreateInfo->getAmouont());
		$array = parent::execute(parent::URLBASE_VAULT.'/transfers', parent::REQUEST_POST, $this->_secretkey, $param);
		
		return new OmiseTransfer($array);
	}
	
	/**
	 * トランスファーIDをもとに１件取得する
	 * @param string $transferID
	 * @return OmiseTransfer
	 */
	public function retrieve($transferID) {
		$array = parent::execute(parent::URLBASE_VAULT.'/transfers/'.$transferID, parent::REQUEST_GET, $this->_secretkey);
		
		return new OmiseTransfer($array);
	}
	
	/**
	 * トランスファーのアップデート
	 * @param OmiseTransferUpdateInfo $transferUpdateInfo
	 * @return OmiseTransfer
	 */
	public function upadte($transferUpdateInfo) {
		$param = array();
		if($transferUpdateInfo->getAmouont() !== null) $param += array(self::PARAM_AMOUNT => $transferUpdateInfo->getAmouont());
		
		$array = parent::execute(parent::URLBASE_VAULT.'/transfers/'.$transferID.$transferUpdateInfo->getTransferID(), parent::REQUEST_GET, $this->_secretkey, $param);
		
		return new OmiseTransfer($array);
	}
}