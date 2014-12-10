<?php
class OmiseChargeUpdateInfo {
	private $_chargeID = null, $_description = null;
	
	public function __construct($chargeID, $description) {
		$this->setChargeID($chargeID);
		$this->setDescription($description);
	}
	
	public function setChargeID($chargeID) {
		$this->_chargeID = $chargeID;
	}
	public function getChargeID() {
		return $this->_chargeID;
	}
	
	public function setDescription($description) {
		$this->_description = $description;
	}
	public function getDescription() {
		return $this->_description;
	}
}