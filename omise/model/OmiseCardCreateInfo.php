<?php
require_once dirname(__FILE__).'/../exception/OmiseException.php';

class OmiseCardCreateInfo {
	private $_description, $_email, $_card;
	
	/**
	 * cardはtokenID
	 * @param string $description
	 * @param string $email
	 * @param string $card
	 * @throws OmiseException
	 */
	public function __construct($description, $email, $card) {
		$error = $this->valid($description, $email, $card);
		if(strlen($error) > 0) throw new OmiseException($error);
		
		$this->_description = $description;
		$this->_email = $email;
		$this->_card = $card;
	}
	
	public function getDescription() {
		return $this->_description;
	}
	
	public function getEmail() {
		return $this->_email;
	}
	
	public function getCard() {
		return $this->_card;
	}
	
	public function valid($description, $email, $card) {
		return $this->validDescription($description).$this->validEmail($email).$this->validCard($card);
	}
	
	/**
	 * descriptionのチェック
	 * @param string $description
	 * @return string|boolean
	 */
	public function validDescription($description) {
		if(!strlen($description)) {
			return 'Description must not be empty.';
		}
	
		return '';
	}
	/**
	 * emailのチェック
	 * @param string $email
	 * @return string|boolean
	 */
	public function validEmail($email) {
		if(!strlen($email)) {
			return 'Email must not be empty.';
		}
	
		return '';
	}
	/**
	 * cardのチェック
	 * @param string $card
	 * @return string|boolean
	 */
	public function validCard($card) {
		if(!strlen($card)) {
			return 'Card must not be empty.';
		}
	
		return '';
	}
}