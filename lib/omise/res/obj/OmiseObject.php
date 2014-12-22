<?php
require_once dirname(__FILE__).'/../../../config.php';

class OmiseObject implements ArrayAccess, Iterator, Countable {
	// 連想配列に使うオブジェクト
	protected $_values = array();
	
	// Omiseの秘密鍵と公開鍵用変数
	protected $_secretkey, $_publickey;
	
	/**
	 * 引数にOmiseの秘密鍵と公開鍵を渡す。config.phpに書いておけば渡さなくても良い
	 * @param string $secretkey
	 * @param string $publickey
	 */
	protected function __construct($publickey = null, $secretkey = null) {
		if($publickey !== null) {
			$this->_publickey = $publickey;
		} else {
			$this->_publickey = OMISE_PUBLIC_KEY;
		}
		if($secretkey !== null) {
			$this->_secretkey = $secretkey;
		} else {
			$this->_secretkey = OMISE_SECRET_KEY;
		}
		$this->_values = array();
	}
	
	/**
	 * リソースを更新する
	 * @param array $values
	 */
	protected function refresh($values) {
		$this->_values = array_merge($this->_values, $values);
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