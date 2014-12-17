<?php
class OmiseError {
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
	 * @return string
	 */
	function getLocation() {
		return $this->_array['location'];
	}
	/**
	 * @return string
	 */
	function getCode() {
		return $this->_array['code'];
	}
	/**
	 * @return string
	 */
	function getMessage() {
		return $this->_array['message'];
	}
}
