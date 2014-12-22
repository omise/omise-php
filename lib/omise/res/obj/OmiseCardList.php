<?php
require_once dirname(__FILE__).'/OmiseList.php';
require_once dirname(__FILE__).'/../../OmiseCards.php';

class OmiseCardList extends OmiseList {
	public function __construct($customer, $publickey = null, $secretkey = null) {
		parent::__construct($publickey, $secretkey);
		
		foreach ($customer['cards']['data'] as $row) {
			$this->push(new OmiseCards($row, $customer['id']));
		}
	}
	
	public function retrieve($id) {
		foreach ($this as $row) {
			if($row['id'] === $id) return $row;
		}
	}
}