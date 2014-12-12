<?php
require_once dirname(__FILE__).'/OmiseCard.php';
require_once dirname(__FILE__).'/OmiseCharge.php';
require_once dirname(__FILE__).'/OmiseCustomer.php';
require_once dirname(__FILE__).'/OmiseTransfer.php';
require_once dirname(__FILE__).'/OmiseTransaction.php';

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
					
				case 'customer':
					array_push($this->_data, new OmiseCustomer($row));
					break;
					
				case 'transfer':
					array_push($this->_data, new OmiseTransfer($row));
					break;
					
				case 'transaction':
					array_push($this->_data, new OmiseTransaction($row));
					break;
			}
		}
	}

	/**
	 * @return string
	 */
	function getObject() {
		return $this->_array['object'];
	}
	/**
	 * @return string
	 */
	function getFrom() {
		return $this->_array['from'];
	}
	/**
	 * @return string
	 */
	function getTo() {
		return $this->_array['to'];
	}
	/**
	 * @return integer
	 */
	function getOffset() {
		return $this->_array['offset'];
	}
	/**
	 * @return integer
	 */
	function getLimit() {
		return $this->_array['limit'];
	}
	/**
	 * @return integer
	 */
	function getTotal() {
		return $this->_array['total'];
	}
	/**
	 * 
	 * @return OmiseCustomer[]|OmiseCharge[]|OmiseCard[]|OmiseTransfer[]|OmiseTransaction[]
	 */
	function getData() {
		return $this->_data;
	}
	/**
	 * @return string
	 */
	function getLocation() {
		return $this->_array['location'];
	}
}
?>