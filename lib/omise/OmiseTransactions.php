<?php
require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseTransactions extends OmiseApiResource {
	const ENDPOINT = 'transactions';
	
	public static function retrive($id = '', $publickey = null, $secretkey = null) {
		return parent::retrive(get_class(), self::getUrl($id), $publickey, $secretkey);
	}

	public function reload() {
		if($this['object'] === 'transaction') {
			parent::reload(self::getUrl($this['id']));
		} else {
			parent::reload(self::getUrl());
		}
	}
	
	private static function getUrl($id = '') {
		return OMISE_API_URL.self::ENDPOINT.'/'.$id;
	}
}