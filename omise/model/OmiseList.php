<?php
require_once dirname(__FILE__).'/OmiseCard.php';
require_once dirname(__FILE__).'/OmiseCharge.php';

class OmiseList {
	private $_array;
	private $_data = array();
	
	function __construct($array) {
		$this->_array = $array;
		
		foreach ($this->_array['data'] as $row) {
			switch($row['object']) {
				case 'charge':
					array_push($this->_data, new OmiseCharge($row));
					break;
					
				case 'card':
					array_push($this->_data, new OmiseCard($row));
					break;
			}
		}
	}
	
	function getObject() {
		return $this->_array['object'];
	}
	function getFrom() {
		return $this->_array['from'];
	}
	function getTo() {
		return $this->_array['to'];
	}
	function getOffset() {
		return $this->_array['offset'];
	}
	function getLimit() {
		return $this->_array['limit'];
	}
	function getTotal() {
		return $this->_array['total'];
	}
	function getData() {
		return $this->_data;
	}
}
?>