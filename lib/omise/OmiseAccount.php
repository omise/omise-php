<?php
require_once dirname(__FILE__).'/resource/OmiseResourceSingleton.php';

class OmiseAccount extends OmiseResourceSingleton {
	protected $_endpoint = 'account';
	
	public static function retrive($publickey, $secretkey) {
		return parent::retrive(get_class(), $publickey, $secretkey);
	}
}