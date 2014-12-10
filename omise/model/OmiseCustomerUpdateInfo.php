<?php
require_once dirname(__FILE__).'/OmiseCustomerInfo.php';

class OmiseCustomerUpdateInfo extends OmiseCustomerInfo {
	private $_customerID;
	
	public function __construct($customerID = null, $email = null, $description = null, $card = null) {
		parent::__construct($email, $description, $card);
		
		$this->setCustomerID($customerID);
	}
	
	public function setCustomerID($customerID) {
		$this->_customerID = $customerID;
	}
	public function getCustomerID() {
		return $this->_customerID;
	}
}