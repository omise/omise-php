<?php
class OmiseException extends Exception {
	private $_omiseError = null;
	
	public function __construct($message = null, $omiseError = null) {
		parent::__construct($message);
		$this->setOmiseError($omiseError);
	}
	
	/**
	 * OmiseErrorをセットする
	 * @param OmiseError $omiseError
	 */
	public function setOmiseError($omiseError) {
		$this->_omiseError = $omiseError;
	}
	
	/**
	 * OmiseErrorオブジェクトを取得する。この例外がOmiseAPIに定義されたエラー以外で発生した場合nullが帰る。（HTTP通信の失敗等）
	 * 参考：https://docs.omise.co/api/errors/
	 * @return OmiseError
	 */
	public function getOmiseError() {
		return $this->_omiseError;
	}
}

