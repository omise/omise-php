<?php
require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseCharges extends OmiseApiResource {
	const ENDPOINT = 'charges';
	
	public static function retrive($id = '', $publickey = null, $secretkey = null) {
		return parent::retrive(get_class(), self::getUrl($id), $publickey, $secretkey);
	}

	public static function create($params, $publickey = null, $secretkey = null) {
		return parent::create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
	}
	
	public function update($params) {
		return parent::update(self::getUrl($this['id']), $params);
	}
	
	private static function getUrl($id = '') {
		return OMISE_API_URL.self::ENDPOINT.'/'.$id;
	}
}