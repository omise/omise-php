<?php
require_once dirname(__FILE__).'/OmiseList.php';

class OmiseCustomer {
	private $_array;
	private $_cards;
	
	function __construct($array) {
		$this->_array = $array;

		$this->_cards = new OmiseList($this->_array['cards']);
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
	 * @return string
	 */
	function getLocation() {
		return $this->_array['location'];
	}
	/**
	 * @return string
	 */
	function getDefaultCard() {
		return $this->_array['default_card'];
	}
	/**
	 * @return string
	 */
	function getEmail() {
		return $this->_array['email'];
	}
	/**
	 * @return string
	 */
	function getDescription() {
		return $this->_array['description'];
	}
	/**
	 * 
	 * @return OmiseList
	 */
	function getCards() {
		return $this->_cards;
	}
	/**
	 * @return boolean
	 */
	function getDeleted() {
		return $this->_array['deleted'];
	}
}