<?php
class OmiseAccount {
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
	function getID() {
		return $this->_array['id'];
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
	function getCreated() {
		return $this->_array['created'];
	}
}
