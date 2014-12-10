<?php
class OmiseTransfer {
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
	public function getLivemode() {
		return $this->_array['livemode'];
	}
	public function getLocation() {
		return $this->_array['location'];
	}
	public function getSent() {
		return $this->_array['sent'];
	}
	public function getPaid() {
		return $this->_array['paid'];
	}
	public function getAmount() {
		return $this->_array['amount'];
	}
	public function getCurrency() {
		return $this->_array['currency'];
	}
	public function getFailureCode() {
		return $this->_array['failure_code'];
	}
	public function getFailureMessage() {
		return $this->_array['failure_message'];
	}
	public function getTransaction() {
		return $this->_array['transaction'];
	}
	public function getCreated() {
		return $this->_array['created'];
	}
}