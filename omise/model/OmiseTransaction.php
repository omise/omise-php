<?php
class OmiseTransaction {
	private $_array;
	
	public function __construct($array) {
		$this->_array = $array;
	}
	
	public function getObject() {
		return $this->_array['object'];
	}
	public function getID() {
		return $this->_array['id'];
	}
	public function getType() {
		return $this->_array['type'];
	}
	public function getAmount() {
		return $this->_array['amount'];
	}
	public function getCurrency() {
		return $this->_array['currency'];
	}
	public function getCreated() {
		return $this->_array['created'];
	}
}