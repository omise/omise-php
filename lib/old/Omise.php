<?php
require_once dirname(__FILE__).'/access/OmiseAccessAccount.php';
require_once dirname(__FILE__).'/access/OmiseAccessBalance.php';
require_once dirname(__FILE__).'/access/OmiseAccessTokens.php';
require_once dirname(__FILE__).'/access/OmiseAccessCards.php';
require_once dirname(__FILE__).'/access/OmiseAccessCharges.php';
require_once dirname(__FILE__).'/access/OmiseAccessCustomers.php';
require_once dirname(__FILE__).'/access/OmiseAccessTransfers.php';
require_once dirname(__FILE__).'/access/OmiseAccessTransactions.php';

class Omise {
	// Omiseの秘密鍵と公開鍵用変数
	private $_secretkey;
	private $_publickey;
	
	// Accessクラスへの参照
	private $_omiseAccessAccount = null;
	private $_omiseAccessBalance = null;
	private $_omiseAccessTokens = null;
	private $_omiseAccessCards = null;
	private $_omiseAccessCharges = null;
	private $_omiseAccessCustomers = null;
	private $_omiseAccessTransfers = null;
	private $_omiseAccessTransactions = null;
	
	/**
	 * 引数にOmiseの秘密鍵と公開鍵を渡す
	 * @param string $secretkey
	 * @param string $publickey
	 */
	public function __construct($publickey, $secretkey) {
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
	 * @return OmiseAccessTokens
	 */
	public function getOmiseAccessTokens() {
		if($this->_omiseAccessTokens === null) {
			$this->_omiseAccessTokens = new OmiseAccessTokens($this->_secretkey, $this->_publickey);
		}
		
		return $this->_omiseAccessTokens;
	}
	
	/**
	 * API:Cardsへ接続するためのオブジェクトを返す
	 * @return OmiseAccessCards
	 */
	public function getOmiseAccessCards() {
		if($this->_omiseAccessCards === null) {
			$this->_omiseAccessCards = new OmiseAccessCards($this->_secretkey, $this->_publickey);
		}
		
		return $this->_omiseAccessCards;
	}
	
	/**
	 * API:Chargesへ接続するためのオブジェクトを返す
	 * @return OmiseAccessCharges
	 */
	public function getOmiseAccessCharges() {
		if($this->_omiseAccessCharges === null) {
			$this->_omiseAccessCharges = new OmiseAccessCharges($this->_secretkey, $this->_publickey);
		}
		
		return $this->_omiseAccessCharges;
	}

	/**
	 * API:Customersへ接続するためのオブジェクトを返す
	 * @return OmiseAccessCustomers
	 */
	public function getOmiseAccessCustomers() {
		if($this->_omiseAccessCustomers === null) {
			$this->_omiseAccessCustomers = new OmiseAccessCustomers($this->_secretkey, $this->_publickey);
		}
	
		return $this->_omiseAccessCustomers;
	}

	/**
	 * API:Transfersへ接続するためのオブジェクトを返す
	 * @return OmiseAccessTransfers
	 */
	public function getOmiseAccessTransfers() {
		if($this->_omiseAccessTransfers === null) {
			$this->_omiseAccessTransfers = new OmiseAccessTransfers($this->_secretkey, $this->_publickey);
		}
	
		return $this->_omiseAccessTransfers;
	}

	/**
	 * API:Transactionsへ接続するためのオブジェクトを返す
	 * @return OmiseAccessTransactions
	 */
	public function getOmiseAccessTransactions() {
		if($this->_omiseAccessTransactions === null) {
			$this->_omiseAccessTransactions = new OmiseAccessTransactions($this->_secretkey, $this->_publickey);
		}
	
		return $this->_omiseAccessTransactions;
	}
}
