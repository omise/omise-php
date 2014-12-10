<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';
require_once dirname(__FILE__).'/../model/OmiseTransfer.php';

class OmiseAccessTransfers extends OmiseAccessBase {
	/**
	 * トランスファーのリストを取得する
	 * @return OmiseTransfer
	 */
	public function listAll() {
		$array = parent::execute(parent::URLBASE_VAULT.'/transfers', parent::REQUEST_GET, $this->_secretkey);
		
		return new OmiseTransfer($array);
	}
}