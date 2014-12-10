<?php
abstract class OmiseTransferInfo {
	private $_amount = null;
	
	public function __construct($amount = null) {
		$this->setAmoount($amount);
	}
	
	public function setAmoount($amount) {
		$this->_amount = $amount;
	}
	public function getAmouont() {
		return $this->_amount;
	}
}