<?php
require_once dirname(__FILE__).'/OmiseTransferInfo.php';

class OmiseTransferUpdateInfo extends OmiseTransferInfo {
	private $_transferID = null;
	
	public function __construct($transferID = null, $amount = null) {
		parent::__construct($amount);
		$this->setTransferID($transferID);
	}
	
	public function setTransferID($transferID) {
		$this->_transferID = $transferID;
	}
	public function getTransferID() {
		return $this->_transferID;
	}
}