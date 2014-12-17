<?php
class OmiseCardUpdateInfo {
	private $_cardID = null, $_customerID = null, $_name = null, $_expirationMonth = null, $_expirationYear = null, $_postalCode = null, $_city = null;
	
	/**
	 * @param string $cardID
	 * @param string $customerID
	 * @param string $name
	 * @param integer $expirationMonth
	 * @param integer $expirationYear
	 * @param string $postalCode
	 * @param string $city
	 * @throws OmiseException
	 */
	public function __construct($cardID = null, $customerID = null, $name = null, $expirationMonth = null, $expirationYear = null, $postalCode = null, $city = null) {
		$this->setCardID($cardID);
		$this->setCustomerID($customerID);
		$this->setName($name);
		$this->setExpirationMonth($expirationMonth);
		$this->setExpirationYear($expirationYear);
		$this->setPostalCode($postalCode);
		$this->setCity($city);
	}
	
	public function setCardID($cardID) {
		$this->_cardID = $cardID;
	}
	public function getCardID() {
		return $this->_cardID;
	}
	
	public function setCustomerID($customerID) {
		$this->_customerID = $customerID;
	}
	public function getCustomerID() {
		return $this->_customerID;
	}
	
	public function setName($name) {
		$this->_name = $name;
	}
	public function getName() {
		return $this->_name;
	}
	
	public function setExpirationMonth($expirationMonth) {
		//if(!preg_match("/^[0-9]+$/", $expirationMonth)) throw new OmiseException('Expiration month is an integer.');
		//if($expirationMonth < 1 || 12 < $expirationMonth) throw new OmiseException('Illegal expiration month was entered.');
		
		$this->_expirationMonth = $expirationMonth;
	}
	public function getExpirationMonth() {
		return $this->_expirationMonth;
	}
	
	public function setExpirationYear($expirationYear) {
		//if(!preg_match("/^[0-9]{4}$/", $expirationYear)) throw new OmiseException('Expiration year is 4 -digit integer.');
		
		$this->_expirationYear = $expirationYear;
	}
	public function getExpirationYear() {
		return $this->_expirationYear;
	}
	
	public function setPostalCode($postalCode) {
		$this->_postalCode = $postalCode;
	}
	public function getPostalCode() {
		return $this->_postalCode;
	}
	
	public function setCity($city) {
		$this->_city = $city;
	}
	public function getCity() {
		return $this->_city;
	}
}