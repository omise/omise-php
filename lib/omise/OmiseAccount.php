<?php
require_once dirname(__FILE__).'/resource/OmiseApiResourceSingleton.php';

class OmiseAccount extends OmiseApiResource {
	protected $_endpoint = 'account';
	
	public static function retrive($publickey = null, $secretkey = null) {
		return parent::retrive(get_class(), $publickey, $secretkey);
	}
}