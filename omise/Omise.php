<?php
require_once dirname(__FILE__).'/access/OmiseAccessAccount.php';
require_once dirname(__FILE__).'/access/OmiseAccessBalance.php';
require_once dirname(__FILE__).'/access/OmiseAccessTokens.php';

class Omise {
	// Omiseの秘密鍵と公開鍵用変数
	private $_secretkey;
	private $_publickey;
	
	// Accessクラスへの参照
	private $_omiseAccessAccount = null;
	private $_omiseAccessBalance = null;
	private $_omiseAccessTokens = null;
	
	/**
	 * 引数にOmiseの秘密鍵と公開鍵を渡す
	 * @param string $secretkey
	 * @param string $publickey
	 */
	public function __construct($secretkey, $publickey) {
		if(!isset($secretkey) || !isset($publickey)) {
			throw new OmiseException('Input of secret key and public key is required');
		}
		
		$this->_secretkey = $secretkey;
		$this->_publickey = $publickey;
	}
	
	/**
	 * API:Accountへ接続するためのオブジェクトを返す
	 * @return OmiseAccessAccount
	 */
	public function getOmiseAccessAccount() {
		if($this->_omiseAccessAccount === null) {
			$this->_omiseAccessAccount = new OmiseAccessAccount($this->_secretkey, $this->_publickey);
		}
		
		return $this->_omiseAccessAccount;
	}
	
	/**
	 * API:Balanceへ接続するためのオブジェクトを返す
	 * @return OmiseAccessBalance
	 */
	public function getOmiseAccessBalance() {
		if($this->_omiseAccessBalance === null) {
			$this->_omiseAccessBalance = new OmiseAccessBalance($this->_secretkey, $this->_publickey);
		}
		
		return $this->_omiseAccessBalance;
	}
	
	/**
	 * API:Tokensへ接続するためのオブジェクトを返す
	 * @return 
	 */
	public function getOmiseAccessTokens() {
		if($this->_omiseAccessTokens === null) {
			$this->_omiseAccessTokens = new OmiseAccessTokens($this->_secretkey, $this->_publickey);
		}
		
		return $this->_omiseAccessTokens;
	}
}
