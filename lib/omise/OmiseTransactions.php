<?php
require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseTransactions extends OmiseApiResource {
	const ENDPOINT = 'transfers';
	
	public static function retrive($id = '', $publickey = null, $secretkey = null) {
		return parent::retrive(get_class(), self::getUrl($id), $publickey, $secretkey);
	}
	
	private static function getUrl($id = '') {
		return OMISE_API_URL.self::ENDPOINT.'/'.$id;
	}
}