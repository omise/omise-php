<?php
class OmiseTransaction {
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
	 * @return string
	 */
	public function getType() {
		return $this->_array['type'];
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
	public function getCreated() {
		return $this->_array['created'];
	}
}