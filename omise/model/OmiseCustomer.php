<?php
require_once dirname(__FILE__).'/OmiseList.php';

class OmiseCustomer {
	private $_array;
	private $_cards;
	
	function __construct($array) {
		$this->_array = $array;

		$this->_cards = new OmiseList($this->_array['cards']);
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
	function getDefaultCard() {
		return $this->_array['default_card'];
	}
	function getEmail() {
		return $this->_array['email'];
	}
	function getDescription() {
		return $this->_array['description'];
	}
	function getCards() {
		return $this->_cards;
	}
	function getDeleted() {
		return $this->_array['deleted'];
	}
}