<?php
class OmiseTransfer {
	private $_array;

	public function __construct($array) {
		$this->_array = $array;
	}

	/**
	 * @return string
	 */
	public function getObject() {
		return $this->_array['object'];
	}
	/**
	 * @return string
	 */
	public function getID() {
		return $this->_array['id'];
	}
	/**
	 * @return boolean
	 */
	public function getLivemode() {
		return $this->_array['livemode'];
	}
	/**
	 * @return string
	 */
	public function getLocation() {
		return $this->_array['location'];
	}
	/**
	 * @return boolean
	 */
	public function getSent() {
		return $this->_array['sent'];
	}
	/**
	 * @return boolean
	 */
	public function getPaid() {
		return $this->_array['paid'];
	}
	/**
	 * @return integer
	 */
	public function getAmount() {
		return $this->_array['amount'];
	}
	/**
	 * @return string
	 */
	public function getCurrency() {
		return $this->_array['currency'];
	}
	/**
	 * @return string
	 */
	public function getFailureCode() {
		return $this->_array['failure_code'];
	}
	/**
	 * @return string
	 */
	public function getFailureMessage() {
		return $this->_array['failure_message'];
	}
	public function getTransaction() {
		return $this->_array['transaction'];
	}
	/**
	 * @return string
	 */
	public function getCreated() {
		return $this->_array['created'];
	}
	/**
	 * @return boolean
	 */
	public function getDeleted() {
		return $this->_array['deleted'];
	}
}