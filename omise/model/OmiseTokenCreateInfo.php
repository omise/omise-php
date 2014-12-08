<?php
require_once dirname(__FILE__).'/../exception/OmiseException.php';

class OmiseTokenCreateInfo {
	private $_name, $_number, $_expirationMonth, $_expirationYear, $_securityCode, $_postalCode, $_city;
	
	/**
	 * 
	 * @param string $name
	 * @param string $number
	 * @param string $expirationMonth
	 * @param string $expirationYear
	 * @param string $securityCode
	 * @param string $postalCode
	 * @param string $city
	 * @throws OmiseException
	 */
	public function __construct($name, $number, $expirationMonth, $expirationYear, $securityCode, $postalCode, $city) {
		$error = $this->validCard($name, $number, $expirationMonth, $expirationYear, $securityCode, $postalCode, $city);
		if(strlen($error) > 0) throw new OmiseException($error);
		
		$this->_name = $name;
		$this->_number = $number;
		$this->_expirationMonth = $expirationMonth;
		$this->_expirationYear = $expirationYear;
		$this->_securityCode = $securityCode;
		$this->_postalCode = $postalCode;
		$this->_city = $city;
	}
	
	public function getName() {
		return $this->_name;
	}
	
	public function getNumber() {
		return $this->_number;
	}
	
	public function getExpirationMonth() {
		return $this->_expirationMonth;
	}
	
	public function getExpirationYear() {
		return $this->_expirationYear;
	}
	
	public function getSecurityCode() {
		return $this->_securityCode;
	}
	
	public function getPostalCode() {
		return $this->_postalCode;
	}
	
	public function getCity() {
		return $this->_city;
	}
	

	/**
	 * クレジットカードの入力チェックを行う。
	 *
	 * @param string $name
	 * @param string $number
	 * @param string $expirationMonth
	 * @param string $expirationYear
	 * @param string $securityCode
	 * @param string $postalCode
	 * @param string $city
	 * @return string|boolean
	 */
	private function validCard($name, $number, $expirationMonth, $expirationYear, $securityCode, $postalCode, $city) {
		$errors = '';
	
		$numlen = strlen($number);
		$seccodelen = strlen($securityCode);
		if(!strlen($name)) {
			$errors.='Name must not be empty.';
		} else if($numlen < 14 || 16 < $numlen || !preg_match("/^[0-9]+$/", $number)) {
			$errors.='Card number must be a 16 -digit number from 14 digits.';
		} else if(strlen($expirationMonth) != 2 || !preg_match("/^[0-9]+$/", $expirationMonth) || $expirationMonth < 1 || 12 < $expirationMonth) {
			$errors.='Expiration Month must be a number of 01-12.';
		} else if(strlen($expirationYear) != 4 || !preg_match("/^[0-9]+$/", $expirationYear)) {
			$errors.='Expiration Year must be a 4 -digit number.';
		} else if($seccodelen < 3 || 4 < $seccodelen || !preg_match("/^[0-9]+$/", $securityCode)) {
			$errors.='Security Code must be a 4 -digit number from 3 digits.';
		} else if(!strlen($postalCode)) {
			$errors.='Postal Code must not be empty.';
		} else if(!strlen($city)) {
			$errors.='City must not be empty.';
		}
	
		return $errors;
	}
}