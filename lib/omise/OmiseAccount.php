<?php
require_once dirname(__FILE__).'/resource/OmiseApiResourceSingleton.php';

class OmiseAccount extends OmiseApiResourceSingleton {
	const ENDPOINT = 'account';
	
	public static function retrive($publickey = null, $secretkey = null) {
		return parent::retrive(get_class(), self::getUrl(), $publickey, $secretkey);
	}

	public function reload() {
		parent::reload(self::getUrl());
	}

	private static function getUrl($id = '') {
		return OMISE_API_URL.self::ENDPOINT.'/'.$id;
	}
}