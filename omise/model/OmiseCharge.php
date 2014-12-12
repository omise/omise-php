<?php
require_once dirname(__FILE__).'/OmiseCard.php';

class OmiseCharge {
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
	 * @return integer
	 */
	function getAmount() {
		return $this->_array['amount'];
	}
	/**
	 * @return string
	 */
	function getCurrency() {
		return $this->_array['currency'];
	}
	/**
	 * @return string
	 */
	function getDescription() {
		return $this->_array['description'];
	}
	/**
	 * @return boolean
	 */
	function getCapture() {
		return $this->_array['capture'];
	}
	/**
	 * @return boolean
	 */
	function getAuthorized() {
		return $this->_array['authorized'];
	}
	/**
	 * @return boolean
	 */
	function getCaptured() {
		return $this->_array['captured'];
	}
	/**
	 * @return string
	 */
	function getTransaction() {
		return $this->_array['transaction'];
	}
	function getFailureCode() {
		return $this->_array['failure_code'];
	}
	function getFailureMessage() {
		return $this->_array['failure_message'];
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
	function getCustomer() {
		return $this->_array['customer'];
	}
	/**
	 * @return string
	 */
	function getIP() {
		return $this->_array['ip'];
	}
	/**
	 * @return string
	 */
	function getCreated() {
		return $this->_array['created'];
	}
}