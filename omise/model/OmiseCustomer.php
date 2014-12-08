<?php
require_once dirname(__FILE__).'/OmiseList.php';

class OmiseCustomer {
	private $_array;
	private $_cards = array();
	
	function __construct($array) {
		$this->_array = $array;
		
		foreach ($this->_array['cards'] as $row) {
			array_push($this->_cards, new OmiseList($row));
		}
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
		return $this->_array['cards'];
	}
}