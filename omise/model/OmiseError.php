<?php
class OmiseError {
	private $_array;
	
	function __construct($array) {
		$this->_array = $array;
	}
	
	function getObject() {
		return $this->_array['object'];
	}
	function getLocation() {
		return $this->_array['location'];
	}
	function getCode() {
		return $this->_array['code'];
	}
	function getMessage() {
		return $this->_array['message'];
	}
}
