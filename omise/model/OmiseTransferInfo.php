<?php
abstract class OmiseTransferInfo {
	private $_amount = null;
	
	public function __construct($amount = null) {
		$this->setAmount($amount);
	}
	
	public function setAmount($amount) {
		$this->_amount = $amount;
	}
	public function getAmouont() {
		return $this->_amount;
	}
}