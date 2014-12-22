<?php
require_once dirname(__FILE__).'/res/OmiseApiResourceSingleton.php';

class OmiseBalance extends OmiseApiResourceSingleton {
	const ENDPOINT = 'balance';
	
	public static function retrieve($publickey = null, $secretkey = null) {
		return parent::retrieve(get_class(), self::getUrl(), $publickey, $secretkey);
	}

	public function reload() {
		parent::reload(self::getUrl());
	}

	private static function getUrl($id = '') {
		return OMISE_API_URL.self::ENDPOINT.'/'.$id;
	}
}
