<?php
require_once dirname(__FILE__).'/OmiseCard.php';

class OimseTokens {
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
	function getLocation() {
		return $this->_array['location'];
	}
	function getUsed() {
		return $this->_array['used'];
	}
	function getCard() {
		return new OmiseCard($this->_array['card']);
	}
	function getCreated() {
		return $this->_array['created'];
	}
}