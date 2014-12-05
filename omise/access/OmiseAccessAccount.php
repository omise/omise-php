<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';
require_once dirname(__FILE__).'/../model/OmiseAccount.php';

class OmiseAccessAccount extends OmiseAccessBase {
	/**
	 * @throws OmiseException
	 * @return OmiseAccount
	 */
	function retrieve() {
		$array = parent::execute(parent::URLBASE_API.'/account', parent::REQUEST_GET);
		
		return new OmiseAccount($array);
	}
}
?>