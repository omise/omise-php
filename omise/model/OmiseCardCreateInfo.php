<?php
class OmiseCardCreateInfo {
	private $_name, $_number, $_expirationMonth, $_expirationYear, $_securityCode, $_postalCode, $_city;
	
	public function __construct($name, $number, $expirationMonth, $expirationYear, $securityCode, $postalCode, $city) {
		$this->setName($name);
		$this->setNumber($number);
		$this->setExpirationMonth($expirationMonth);
		$this->setExpirationYear($expirationYear);
		$this->setSecurityCode($securityCode);
		$this->setPostalCode($postalCode);
		$this->setCity($city);
	}
	
	public function setName($name) {
		$this->_name = $name;
	}
	public function getName() {
		return $this->_name;
	}
	
	public function setNumber($number) {
		$this->_number = $number;
	}
	public function getNumber() {
		return $this->_number;
	}
	
	public function setExpirationMonth($expirationMonth) {
		$this->_expirationMonth = $expirationMonth;
	}
	public function getExpirationMonth() {
		return $this->_expirationMonth;
	}
	
	public function setExpirationYear($expirationYear) {
		$this->_expirationYear = $expirationYear;
	}
	public function getExpirationYear() {
		return $this->_expirationYear;
	}
	
	public function setSecurityCode($secutityCode) {
		$this->_securityCode = $secutityCode;
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