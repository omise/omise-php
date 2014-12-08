<?php
class OmiseCardCreateInfo {
	private $_description = null, $_email = null, $_card = null;
	
	/**
	 * cardはtokenID
	 * @param string $description
	 * @param string $email
	 * @param string $card
	 * @throws OmiseException
	 */
	public function __construct($description = null, $email = null, $card = null) {
		$this->setDescription($description);
		$this->setEmail($email);
		$this->setCard($card);
	}
	
	public function setDescription($description) {
		//if(!strlen($description)) new OmiseException('Description must not be empty.');
		$this->_description = $description;
	}
	public function getDescription() {
		return $this->_description;
	}
	
	public function setEmail($email) {
		//if(!strlen($email)) new OmiseException('Email must not be empty.');
		$this->_email = $email;
	}
	public function getEmail() {
		return $this->_email;
	}
	
	public function setCard($card) {
		//if(!strlen($card)) new OmiseException('Card must not be empty.');
		$this->_card = $card;
	}
	public function getCard() {
		return $this->_card;
	}
}