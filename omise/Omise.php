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
	
	// カード情報を必要とするAPIへ渡すカード情報
	private $_card = null;
	
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
	
	public function initCard($name, $number, $expirationMonth, $expirationYear, $securityCode, $postalCode, $city) {
		$errors = $this->validCard($name, $number, $expirationMonth, $expirationYear, $securityCode, $postalCode, $city);
		if(strlen($errors) > 0) throw new OmiseException($error);
		
		$card = new OmiseCard();
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
		if($this->_card === null) {
			throw new OmiseException('First, please initialize the card information.[Omise::initCard($cardName, $cardNumber, $cardExpirationMonth, $cardExpirationYear, $cardSecurityCode, $cardPostalCode, $cardCity)]');
		} else if($this->_omiseAccessTokens === null) {
			$this->_omiseAccessTokens = new OmiseAccessTokens($this->_secretkey, $this->_publickey, );
		}
		
		return $this->_omiseAccessTokens;
	}
	
	/**
	 * クレジットカードの入力チェックを行う。
	 * 
	 * @param string $name
	 * @param string $number
	 * @param string $expirationMonth
	 * @param string $expirationYear
	 * @param string $securityCode
	 * @param string $postalCode
	 * @param string $city
	 * @return string|boolean
	 */
	private function validCard($name, $number, $expirationMonth, $expirationYear, $securityCode, $postalCode, $city) {
		$errors = '';
		
		$numlen = strlen($number);
		$seccodelen = strlen($securityCode);
		if(!strlen($name)) {
			$errors.='Name must not be empty.';
		} else if($numlen < 14 || 16 < $numlen || !preg_match("/^[0-9]+$/", $number)) {
			$errors.='Card number must be a 16 -digit number from 14 digits.';
		} else if(strlen($expirationMonth) != 2 || !preg_match("/^[0-9]+$/", $expirationMonth) || $expirationMonth < 1 || 12 < $expirationMonth) {
			$errors.='Expiration Month must be a number of 01-12.';
		} else if(strlen($expirationYear) != 4 || !preg_match("/^[0-9]+$/", $expirationYear)) {
			$errors.='Expiration Year must be a 4 -digit number.';
		} else if($seccodelen < 3 || 4 < $seccodelen || !preg_match("/^[0-9]+$/", $securityCode)) {
			$errors.='Security Code must be a 4 -digit number from 3 digits.';
		} else if(!strlen($postalCode)) {
			$errors.='Postal Code must not be empty.';
		} else if(!strlen($city)) {
			$errors.='City must not be empty.';
		}
		
		return $errors;
	}
}
