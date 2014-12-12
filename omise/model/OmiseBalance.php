<?php
class OmiseBalance {
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
	 * @return boolean
	 */
	function getLivemode() {
		return $this->_array['livemode'];
	}
	/**
	 * @return integer
	 */
	function getAvailable() {
		return $this->_array['available'];
	}
	/**
	 * @return integer
	 */
	function getTotal() {
		return $this->_array['total'];
	}
	/**
	 * @return string
	 */
	function getCurrency() {
		return $this->_array['currency'];
	}
}
