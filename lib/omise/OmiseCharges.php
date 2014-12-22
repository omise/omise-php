<?php
require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseCharges extends OmiseApiResource {
	const ENDPOINT = 'charges';
	
	public static function retrive($publickey = null, $secretkey = null) {
		return parent::retrive(get_class(), self::getUrl(), $publickey, $secretkey);
	}
	
	private static function getUrl($id = '') {
		return OMISE_API_URL.self::ENDPOINT.'/'.$id;
	}
}