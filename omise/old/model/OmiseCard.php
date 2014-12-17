<?php
class OmiseCard {
	private $_array;
	
	function __construct($array) {
		$this->_array = $array;
	}

	/**
	 * @return string
	 */
	function getObject() {
		return $this->_array['object'];
	}
	/**
	 * @return string
	 */
	function getID() {
		return $this->_array['id'];
	}
	/**
	 * @return boolean
	 */
	function getLivemode() {
		return $this->_array['livemode'];
	}
	/**
	 * @return boolean
	 */
	function getLocation() {
		return $this->_array['location'];
	}
	/**
	 * @return string
	 */
	function getCountry() {
		return $this->_array['country'];
	}
	/**
	 * @return string
	 */
	function getCity() {
		return $this->_array['city'];
	}
	/**
	 * @return string
	 */
	function getPostalCode() {
		return $this->_array['postal_code'];
	}
	/**
	 * @return string
	 */
	function getFinancing() {
		return $this->_array['financing'];
	}
	/**
	 * @return string
	 */
	function getLastDigits() {
		return $this->_array['last_digits'];
	}
	/**
	 * @return string
	 */
	function getBrand() {
		return $this->_array['brand'];
	}
	/**
	 * @return integer
	 */
	function getExpirationMonth() {
		return $this->_array['expiration_month'];
	}
	/**
	 * @return integer
	 */
	function getExpirationYear() {
		return $this->_array['expiration_year'];
	}
	/**
	 * @return string
	 */
	function getFingerprint() {
		return $this->_array['fingerprint'];
	}
	/**
	 * @return string
	 */
	function getName() {
		return $this->_array['name'];
	}
	/**
	 * @return boolean
	 */
	function getSecurityCodeCheck() {
		return $this->_array['security_code_check'];
	}
	/**
	 * @return string
	 */
	function getCreated() {
		return $this->_array['created'];
	}
	/**
	 * @return boolean
	 */
	function getDeleted() {
		return $this->_array['deleted'];
	}
}