<?php
class OmiseObject implements ArrayAccess, Iterator, Countable {
	// 連想配列に使うオブジェクト
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
	
	// ArrayAccessのoverrideメソッド
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

	// Iteratorのoverrideメソッド
	public function rewind() {
		reset($this->_values);
	}
	public function current() {
		return current($this->_values);
	}
	public function key() {
		return key($this->_values);
	}
	public function next() {
		return next($this->_values);
	}
	public function valid() {
		return ($this->current() !== false);
	}
	
	// Countableのoverrideメソッド
	public function count() {
		return count($this->_values);
	}
}