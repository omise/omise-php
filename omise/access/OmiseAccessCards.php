<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';
require_once dirname(__FILE__).'/../model/OmiseCustomer.php';
require_once dirname(__FILE__).'/../model/OmiseCardCreateInfo.php';

class OmiseAccessCards extends OmiseAccessBase {
	const PARAM_DESCRIPTION = 'description';
	const PARAM_EMAIL = 'email';
	const PARAM_CARD = 'card';
	const PARAM_EXPIRATION_MONTH = 'expiration_month';
	const PARAM_EXPIRATION_YEAR = 'expiration_year';
	const PARAM_NAME = 'name';
	const PARAM_POSTAL_CODE = 'postal_code';
	const PARAM_CITY = 'city';
	
	/*
	 * トークンを作成する。引数はCardCreateInfoオブジェクト(OmiseCustomreCreate::createを参照)
	 * @param OmiseCardCreateInfo $cardCreateInfo
	 * @return OmiseTokens
	public function create($cardCreateInfo) {
		$param = array();
		if($cardCreateInfo->getDescription() !== null) $array += array(self::PARAM_DESCRIPTION => $cardCreateInfo->getDescription());
		if($cardCreateInfo->getEmail() !== null) $array += array(self::PARAM_EMAIL => $cardCreateInfo->getEmail());
		if($cardCreateInfo->getCard() !== null) $array += array(self::PARAM_CARD => $cardCreateInfo->getCard());
		$array = parent::execute(parent::URLBASE_API.'/customers', parent::REQUEST_POST, $this->_secretkey, $param);
		
		return new OmiseCustomer($array);
	}
	*/
	
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
	public function retrieve($customerID, $cardID) {
		$array = parent::execute(parent::URLBASE_API.'/customers/'.$customerID.'/cards/'.$cardID, parent::REQUEST_GET, $this->_secretkey);
		
		return new OmiseCard($array);
	}
	
	/**
	 * カード情報を更新する
	 * @param OmiseCardUpdateInfo $cardUpdateInfo
	 * @return OmiseCard
	 */
	public function update($cardUpdateInfo) {
		$param = array();
		if($cardUpdateInfo->getExpirationMonth() !== null) $param += array(self::PARAM_EXPIRATION_MONTH => $cardUpdateInfo->getExpirationMonth());
		if($cardUpdateInfo->getExpirationYear() !== null) $param += array(self::PARAM_EXPIRATION_YEAR => $cardUpdateInfo->getExpirationYear());
		if($cardUpdateInfo->getName() !== null) $param += array(self::PARAM_NAME => $cardUpdateInfo->getName());
		if($cardUpdateInfo->getPostalCode() !== null) $param += array(self::PARAM_POSTAL_CODE => $cardUpdateInfo->getPostalCode());
		if($cardUpdateInfo->getCity() !== null) $param += array(self::PARAM_CITY => $cardUpdateInfo->getCity());
		$array = parent::execute(parent::URLBASE_API.'/customers/'.$cardUpdateInfo->getCustomerID().'/cards/'.$cardUpdateInfo->getCardID(), parent::REQUEST_PATCH, $this->_secretkey, $param);
		
		return new OmiseCard($array);
	}

	/**
	 * 顧客IDとカードIDに一致するカード情報を破棄する
	 * @param string $customerID
	 * @param string $cardID
	 * @return OmiseCard
	 */
	public function destroy($customerID, $cardID) {
		$array = parent::execute(parent::URLBASE_API.'/customers/'.$customerID.'/cards/'.$cardID, parent::REQUEST_DELETE, $this->_secretkey);
		
		return new OmiseCard($array);
	}
}
?>