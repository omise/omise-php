<?php
class OmiseTokenCreateInfo {
	private $_name = null, $_number = null, $_expirationMonth = null, $_expirationYear = null, $_securityCode = null, $_postalCode = null, $_city = null;
	
	/**
	 * 
	 * @param string $name
	 * @param string $number
	 * @param integer $expirationMonth
	 * @param integer $expirationYear
	 * @param integer|string $securityCode
	 * @param string $postalCode
	 * @param string $city
	 * @throws OmiseException
	 */
	public function __construct($name = null, $number = null, $expirationMonth = null, $expirationYear = null, $securityCode = null, $postalCode = null, $city = null) {
		$this->setName($name);
		$this->setNumber($number);
		$this->setExpirationMonth($expirationMonth);
		$this->setExpirationYear($expirationYear);
		$this->setSecurityCode($securityCode);
		$this->setPostalCode($postalCode);
		$this->setCity($city);
	}
	
	public function setName($name) {
		//if(!strlen($name)) new OmiseException('Name must not be empty.');
		$this->_name = $name;
	}
	public function getName() {
		return $this->_name;
	}
	
	public function setNumber($number) {
		//if(!preg_match("/^[0-9]{14,16}$/", $number)) new OmiseException('Number must be a 16 -digit number from 14 digits.');
		$this->_number = $number;
	}
	public function getNumber() {
		return $this->_number;
	}
	
	public function setExpirationMonth($expirationMonth) {
		//if(!preg_match("/^[0-9]{1,2}$/", $expirationMonth)) throw new OmiseException('Expiration month is 2 -digit integer from 1 -digit.');
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
	
	public function setSecurityCode($securityCode) {
		//if(!preg_match("/^[0-9]{3,4}$/", $securityCode)) throw new OmiseException('Security code is a number.');
		$this->_securityCode = $securityCode;
	}
	public function getSecurityCode() {
		return $this->_securityCode;
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