<?php
require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseCards extends OmiseApiResource {
	public function __construct($array, $publickey = null, $secretkey = null) {
		parent::__construct($publickey, $secretkey);
		
		$this->refresh($array);
	}

	public function reload() {
		parent::reload(self::getUrl($this['id']));
	}
}