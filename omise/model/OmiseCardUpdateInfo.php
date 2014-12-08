<?php
require_once dirname(__FILE__).'/../exception/OmiseException.php';

class OmiseCardUpdateInfo {
	private $_cardID, $_customerID, $_name, $_expirationMonth, $_expirationYear, $_postalCode, $_city;
	
	/**
	 * 
	 * @param string $cardID
	 * @param string $customerID
	 * @param string $name
	 * @param string $expirationMonth
	 * @param string $expirationYear
	 * @param string $postalCode
	 * @param string $city
	 * @throws OmiseException
	 */
	public function __construct($cardID, $customerID, $name, $expirationMonth, $expirationYear, $postalCode, $city) {
		$error = $this->valid($cardID, $customerID, $name, $expirationMonth, $expirationYear, $postalCode, $city);
		if(strlen($error) > 0) throw new OmiseException($error);
		
		$this->_cardID = $cardID;
		$this->_customerID = $customerID;
		$this->_name = $name;
		$this->_expirationMonth = $expirationMonth;
		$this->_expirationYear = $expirationYear;
		$this->_postalCode = $postalCode;
		$this->_city = $city;
	}
	
	public function valid($cardID, $customerID, $name, $expirationMonth, $expirationYear, $postalCode, $city) {
		return $this->validCardID($cardID).$this->validCustomerID($customerID).$this->validName($name).
				$this->validExpirationMonth($expirationMonth).$this->validExpirationYear($expirationYear).
				$this->validPostalCode($postalCode).$this->validCity($city);
	}
	
	public function getCardID() {
		return $this->_cardID;
	}
	public function getCustomerID() {
		return $this->_customerID;
	}
	public function getName() {
		return $this->_name;
	}
	public function getExpirationMonth() {
		return $this->_expirationMonth;
	}
	public function getExpirationYear() {
		return $this->_expirationYear;
	}
	public function getPostalCode() {
		return $this->_postalCode;
	}
	public function getCity() {
		return $this->_city;
	}
	
	/**
	 * カードIDの検証
	 * @param string $cardID
	 * @return string
	 */
	public function validCardID($cardID) {
		if(!strlen($cardID)) return 'Card ID must not be empty.';
	
		return '';
	}
	/**
	 * 顧客IDの検証
	 * @param string $customerID
	 * @return string
	 */
	public function validCustomerID($customerID) {
		if(!strlen($customerID)) return 'Customer ID must not be empty.';

		return '';
	}
	/**
	 * 名前の検証
	 * @param string $name
	 * @return string
	 */
	public function validName($name) {
		if(!strlen($customerID)) return 'Name must not be empty.';

		return '';
	}
	/**
	 * 有効期限（月）の検証
	 * @param string $expirationMonth
	 * @return string
	 */
	public function validExpirationMonth($expirationMonth) {
		if(!strlen($expirationMonth)) return 'Expiration month must not be empty.';
		
		return '';
	}
	/**
	 * 有効期限（年）の検証
	 * @param string $expirationYear
	 * @return string
	 */
	public function validExpirationYear($expirationYear) {
		if(!strlen($expirationYear)) return 'Expiration year must not be empty.';
		
		return '';
	}
	/**
	 * 郵便番号の検証
	 * @param string $postalCode
	 * @return string
	 */
	public function validPostalCode($postalCode) {
		if(!strlen($postalCode)) return 'Postal code must not be empty.';
		
		return '';
	}
	/**
	 * 街の検証
	 * @param string $city
	 * @return string
	 */
	public function validCity($city) {
		if(!strlen($city)) return 'City must not be empty.';
		
		return '';
	}
}