<?php
class OmiseAccount {
	private $_array;
	
	function __construct($array) {
		$this->_array = $array;
	}
	
	function getObject() {
		return $this->_array['object'];
	}
	function getID() {
		return $this->_array['id'];
	}
	function getEmail() {
		return $this->_array['email'];
	}
	function getCreated() {
		return $this->_array['created'];
	}
}
