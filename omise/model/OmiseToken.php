<?php
require_once dirname(__FILE__).'/OmiseCard.php';

class OmiseToken {
	private $_array;
	private $_card;
	
	function __construct($array) {
		$this->_array = $array;
		$this->_card = new OmiseCard($this->_array['card']);
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
	 * @return boolean
	 */
	function getUsed() {
		return $this->_array['used'];
	}
	/**
	 * @return OmiseCard
	 */
	function getCard() {
		return $this->_card;
	}
	/**
	 * @return string
	 */
	function getCreated() {
		return $this->_array['created'];
	}
}