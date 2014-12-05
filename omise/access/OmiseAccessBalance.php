<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';
require_once dirname(__FILE__).'/../model/OmiseBalance.php';

class OmiseAccessBalance extends OmiseAccessBase {
	/**
	 * @throws OmiseException
	 * @return OmiseBalance
	 */
	function retrieve() {
		$array = parent::execute(parent::URLBASE_API.'/balance', parent::REQUEST_GET);
		
		return new OmiseAccount($array);
	}
}
?>