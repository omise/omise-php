<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';
require_once dirname(__FILE__).'/../model/OmiseList.php';

class OmiseAccessCustomers extends OmiseAccessBase {
	/**
	 * 顧客一覧を取得する
	 * @return OmiseList
	 */
	public function listAll() {
		$array = parent::execute(parent::URLBASE_API.'/customers', parent::REQUEST_GET, $this->_secretkey);
		
		return new OmiseList($array);
	}
}
?>