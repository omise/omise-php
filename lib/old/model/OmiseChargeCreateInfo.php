<?php
require_once dirname(__FILE__).'/../exception/OmiseException.php';

class OmiseChargeCreateInfo {
	private $_customer = null, $_card = null, $_returnUri = null, $_amount = null, $_currency = null, $_capture = null, $_description = null, $_ip = null;
	
	public function __construct($returnUri = null, $amount = null, $customer = null, $card = null, $currency = null, $capture = null, $description = null, $ip = null) {
		$this->setReturnUri($returnUri);
		$this->setAmount($amount);
		$this->setCustomer($customer);
		$this->setCard($card);
		$this->setCurrency($currency);
		$this->setCapture($capture);
		$this->setDescription($description);
		$this->setIP($ip);
	}
	
	public function setCustomer($customer) {
		$this->_customer = $customer;
	}
	public function getCustomer() {
		return $this->_customer;
	}
	
	public function setCard($card) {
		$this->_card = $card;
	}
	public function getCard() {
		return $this->_card;
	}
	
	public function setReturnUri($returnUri) {
		$this->_returnUri = $returnUri;
	}
	public function getReturnUri() {
		return $this->_returnUri;
	}
	
	public function setAmount($amount) {
		$this->_amount = $amount;
	}
	public function getAmount() {
		return $this->_amount;
	}
	
	public function setCurrency($currency) {
		$this->_currency = $currency;
	}
	public function getCurrency() {
		return $this->_currency;
	}
	
	public function setCapture($capture) {
		$this->_capture = $capture;
	}
	public function getCapture() {
		return $this->_capture;
	}
	
	public function setDescription($description) {
		$this->_description = $description;
	}
	public function getDescription() {
		return $this->_description;
	}
	
	public function setIP($ip) {
		$this->_ip = $ip;
	}
	public function getIP() {
		return $this->_ip;
	}
}