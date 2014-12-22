<?php
require_once dirname(__FILE__).'/res/obj/OmiseList.php';
require_once dirname(__FILE__).'/OmiseCards.php';

class OmiseCardList extends OmiseList {
	public function __construct($array, $publickey = null, $secretkey = null) {
		parent::__construct($publickey, $secretkey);
		
		foreach ($array as $row) {
			$this->push(new OmiseCards($row));
		}
	}
	
	public function retrieve($id) {
		foreach ($this as $row) {
			if($row['id'] === $id) return $row;
		}
	}
}