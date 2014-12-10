<?php
class OmiseCustomerInfo {
	private $_email = null, $_description = null, $_card = null;
	
	public function __construct($email = null, $description = null, $card = null) {
		$this->setEmail($email);
		$this->setDescription($description);
		$this->setCard($card);
	}
	
	public function setEmail($email) {
		$this->_email = $email;
	}
	public function getEmail() {
		return $this->_email;
	}
	
	public function setDescription($description) {
		$this->_description = $description;
	}
	public function getDescription() {
		return $this->_description;
	}
	
	public function setCard($card) {
		$this->_card = $card;
	}
	public function getCard() {
		return $this->_card;
	}
}