<?php
require_once dirname(__FILE__).'/OmiseCard.php';

class OmiseToken {
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
	function getUsed() {
		return $this->_array['used'];
	}
	function getCard() {
		return $this->_card;
	}
	function getCreated() {
		return $this->_array['created'];
	}
}