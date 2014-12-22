<?php
require_once dirname(__FILE__).'/resource/OmiseApiResourceSingleton.php';

class OmiseBalance extends OmiseApiResourceSingleton {
	protected $_endpoint = 'balance';
	
	public static function retrive($publickey = null, $secretkey = null) {
		return parent::retrive(get_class(), $publickey, $secretkey);
	}

	public function reload() {
		parent::reload();
	}
}
