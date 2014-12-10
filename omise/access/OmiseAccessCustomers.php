<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';
require_once dirname(__FILE__).'/../model/OmiseCustomer.php';
require_once dirname(__FILE__).'/../model/OmiseList.php';
require_once dirname(__FILE__).'/../model/OmiseCreateCustomerInfo.php';

class OmiseAccessCustomers extends OmiseAccessBase {
	const PARAM_DESCRIPTION = 'description';
	const PARAM_EMAIL = 'email';
	const PARAM_CARD = 'card';
	
	/**
	 * 顧客一覧を取得する
	 * @return OmiseList
	 */
	public function listAll() {
		$array = parent::execute(parent::URLBASE_API.'/customers', parent::REQUEST_GET, $this->_secretkey);
		
		return new OmiseList($array);
	}
	
	/**
	 * 顧客を作成する
	 * @param OmiseCustomerCreateInfo $customerCreateInfo
	 * @return OmiseCustomer
	 */
	public function create($customerCreateInfo) {
		$param = array();
		if($customerCreateInfo->getEmail() !== null) $param += array(self::PARAM_EMAIL => $customerCreateInfo->getEmail());
		if($customerCreateInfo->getDescription() !== null) $param += array(self::PARAM_DESCRIPTION => $customerCreateInfo->getDescription());
		if($customerCreateInfo->getCard() !== null) $param += array(self::PARAM_CARD => $customerCreateInfo->getCard());
		
		$array = parent::execute(parent::URLBASE_API.'/customers', parent::REQUEST_POST, $this->_secretkey, $param);
		
		return new OmiseCustomer($array);
	}
	
	/**
	 * 顧客IDを元に顧客情報を取得する
	 * @param string $customerID
	 * @return OmiseCustomer
	 */
	public function retrieve($customerID) {
		$array = parent::execute(parent::URLBASE_API.'/customers/'.$customerID, self::REQUEST_GET, $this->_secretkey);
		
		return new OmiseCustomer($array);
	}
	
	/**
	 * 顧客情報を更新する
	 * @param OmiseCustomerUpdateInfo $customerUpdateInfo
	 */
	public function update($customerUpdateInfo) {
		$param = array();
		if($customerUpdateInfo->getEmail() !== null) $param += array(self::PARAM_EMAIL => $customerUpdateInfo->getEmail());
		if($customerUpdateInfo->getDescription() !== null) $param += array(self::PARAM_DESCRIPTION => $customerUpdateInfo->getDescription());
		if($customerUpdateInfo->getCard() !== null) $param += array(self::PARAM_CARD => $customerUpdateInfo->getCard());

		$array = parent::execute(parent::URLBASE_API.'/customers/'.$customerUpdateInfo->getCustomerID(), parent::REQUEST_PATCH, $this->_secretkey, $param);
		
		return new OmiseCustomer($array);
	}
	
	/**
	 * 顧客IDを元に顧客を削除する
	 * @param string $customerID
	 * @return OmiseCustomer
	 */
	public function destroy($customerID) {
		$array = parent::execute(parent::URLBASE_API.'/customers/'.$customerID, parent::REQUEST_DELETE, $this->_secretkey);
		
		return new OmiseCustomer($array);
	}
}
?>