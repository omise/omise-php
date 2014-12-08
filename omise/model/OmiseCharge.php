<?php
require_once dirname(__FILE__).'/OmiseCard.php';

class OmiseCharge {
	private $_array;
	private $_card;
	
	function __construct($array) {
		$this->_array = $array;
		$this->_card = new OmiseCard($this->_array['card']);
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
	function getLocation() {
		return $this->_array['location'];
	}
	function getAmount() {
		return $this->_array['amount'];
	}
	function getCurrency() {
		return $this->_array['currency'];
	}
	function getDescription() {
		return $this->_array['description'];
	}
	function getCapture() {
		return $this->_array['capture'];
	}
	function getAuthorized() {
		return $this->_array['authorized'];
	}
	function getCaptured() {
		return $this->_array['captured'];
	}
	function getTransaction() {
		return $this->_array['transaction'];
	}
	function getFailureCode() {
		return $this->_array['failure_code'];
	}
	function getFailureMessage() {
		return $this->_array['failure_message'];
	}
	function getCard() {
		return $this->_card;
	}
	function getCustomer() {
		return $this->_array['customer'];
	}
	function getIP() {
		return $this->_array['ip'];
	}
	function getCreated() {
		return $this->_array['created'];
	}
}