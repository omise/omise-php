<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';
require_once dirname(__FILE__).'/../model/OmiseAccount.php';

class OmiseAccessCharges extends OmiseAccessBase {
	/**
	 * チャージの一覧を取得する
	 * @return OmiseList
	 */
	public function listAll() {
		$array = parent::execute(parent::URLBASE_API.'/charges', parent::REQUEST_GET, $this->_secretkey);
		
		return new OmiseList($array);
	}
	
	public function create() {
		
	}
}