<?php
require_once dirname(__FILE__).'/resource/OmiseResourceSingleton.php';

class OmiseBalance extends OmiseResourceSingleton {
	protected $_endpoint = 'balance';
	
	public static function retrive($publickey, $secretkey) {
		return parent::retrive(get_class(), $publickey, $secretkey);
	}
}
