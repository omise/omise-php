<?php
class OmiseBalance {
	private $_array;
	
	function __construct($array) {
		$this->_array = $array;
	}
	
	function getObject() {
		return $this->_array['object'];
	}
	function getLivemode() {
		return $this->_array['livemode'];
	}
	function getAvailable() {
		return $this->_array['available'];
	}
	function getTotal() {
		return $this->_array['total'];
	}
	function getCurrency() {
		return $this->_array['currency'];
	}
}
