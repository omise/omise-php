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
	
	/**
	 * 顧客IDに紐づくカードのリストを取得する。
	 * @param string $customerID
	 * @return OmiseList
	 */
	public function listAll($customerID) {
		$array = parent::execute(parent::URLBASE_API.'/customers/'.$customerID.'/cards', parent::REQUEST_GET, $this->_secretkey);
		
		return new OmiseList($array);
	}
	
	/**
	 * 顧客IDとカードIDに一致するカード情報を取得する
	 * @param string $customerID
	 * @param string $cardID
	 * @return OmiseCard
	 */
	public function relative($customerID, $cardID) {
		$array = parent::execute(parent::URLBASE_API.'/customers/'.$customerID.'/cards/'.$cardID, parent::REQUEST_GET, $this->_secretkey);
		
		return new OmiseCard($array);
	}
}
?>