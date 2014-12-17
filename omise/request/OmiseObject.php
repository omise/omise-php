<?php
class OmiseObject implements ArrayAccess {
	protected $_values;
	
	// Omiseの秘密鍵と公開鍵用変数
	protected $_secretkey, $_publickey;
	
	/**
	 * 引数にOmiseの秘密鍵と公開鍵を渡す
	 * @param string $secretkey
	 * @param string $publickey
	 */
	public function __construct($secretkey, $publickey) {
		$this->_secretkey = $secretkey;
		$this->_publickey = $publickey;
		$this->_values = array();
	}
	
	// ArrayAccess override method
	public function offsetSet($key, $value) {
		$this->_values[$key] = $value;
	}
	public function offsetExists($key) {
		return isset($this->_values[$key]);
	}
	public function offsetUnset($key) {
		unset($this->_values[$key]);
	}
	public function offsetGet($key) {
		return isset($this->_values[$key]) ? $this->_values[$key] : null;
	}
}