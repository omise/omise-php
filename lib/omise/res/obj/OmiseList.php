<?php
require_once dirname(__FILE__).'/OmiseObject.php';

class OmiseList extends OmiseObject {
	/**
	 * getInstanceせずにインスタンス生成可能にする
	 * @param string $publickey
	 * @param string $secretkey
	 */
	public function __construct($publickey = null, $secretkey = null) {
		parent::__construct($publickey, $secretkey);
	}
	
	/**
	 * データに１件追加する
	 * @param array $array
	 */
	public function push($array) {
		array_push($this->_values, $array);
	}
}