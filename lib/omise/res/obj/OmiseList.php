<?php
require_once dirname(__FILE__).'/OmiseObject.php';

class OmiseList extends OmiseObject {
	public function __construct($array, $publickey = null, $secretkey = null) {
		parent::__construct($publickey, $secretkey);
		
		self::refresh($array);
	}
}