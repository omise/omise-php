<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';
require_once dirname(__FILE__).'/../model/OmiseCustomer.php';
require_once dirname(__FILE__).'/../model/OmiseCardCreateInfo.php';

class OmiseAccessCards extends OmiseAccessBase {
	const PARAM_DESCRIPTION = 'description';
	const PARAM_EMAIL = 'email';
	const PARAM_CARD = 'card';
	
	/**
	 * トークンを作成する。引数はCardCreateInfoオブジェクト
	 * @param OmiseCardCreateInfo $cardCreateInfo
	 * @return OmiseTokens
	 */
	public function create($cardCreateInfo) {
		$param = array(
			self::PARAM_DESCRIPTION => $cardCreateInfo->getDescription(),
			self::PARAM_EMAIL => $cardCreateInfo->getEmail(),
			self::PARAM_CARD => $cardCreateInfo->getCard()
		);
		$array = parent::execute(parent::URLBASE_API.'/customers', parent::REQUEST_POST, $this->_secretkey, $param);
		
		return new OmiseCustomer($array);
	}
	
	
	public function listAll($customerID) {
		$array = parent::execute(parent::URLBASE_API.'/customers/'.$customerID.'/cards', parent::REQUEST_GET, $this->_secretkey);
		
		return new OmiseList($array);
	}
}
?>