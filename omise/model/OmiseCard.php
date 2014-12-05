<?php
class OmiseCard {
	private $_array;
	
	function __construct($array) {
		$this->_array = $array;
	}
	
	function getObject() {
		return $this->_array['object'];
	}
	function getID() {
		return $this->_array['id'];
	}
	function getLivemode() {
		return $this->_array['livemode'];
	}
	function getCountry() {
		return $this->_array['country'];
	}
	function getCity() {
		return $this->_array['city'];
	}
	function getPostalCode() {
		return $this->_array['postal_code'];
	}
	function getFinancing() {
		return $this->_array['financing'];
	}
	function getLastDigits() {
		return $this->_array['last_digits'];
	}
	function getBrand() {
		return $this->_array['brand'];
	}
	function getExpirationMonth() {
		return $this->_array['expiration_month'];
	}
	function getExpirationYear() {
		return $this->_array['expiration_year'];
	}
	function getFingerprint() {
		return $this->_array['fingerprint'];
	}
	function getName() {
		return $this->_array['name'];
	}
	function getCreated() {
		return $this->_array['created'];
	}
}