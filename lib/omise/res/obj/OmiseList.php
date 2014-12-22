<?php
require_once dirname(__FILE__).'/OmiseObject.php';

class OmiseList extends OmiseObject {
	public function __construct($publickey = null, $secretkey = null) {
		parent::__construct($publickey, $secretkey);
	}
	
	public function push($array) {
		array_push($this->_values, $array);
	}
}