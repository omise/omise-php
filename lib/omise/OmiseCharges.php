<?php
require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseCharges extends OmiseApiResource {
	const ENDPOINT = 'charges';
	
	public static function retrive($id = '', $publickey = null, $secretkey = null) {
		return parent::retrive(get_class(), self::getUrl($id), $publickey, $secretkey);
	}

	public function reload() {
		if($this['object'] === 'charge') {
			parent::reload(self::getUrl($this['id']));
		} else {
			parent::reload(self::getUrl());
		}
	}

	public static function create($params, $publickey = null, $secretkey = null) {
		return parent::create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
	}
	
	public function update($params) {
		return parent::update(self::getUrl($this['id']), $params);
	}
	
	public function capture() {
		$result = parent::execute(self::getUrl($this['id']).'/capture', parent::REQUEST_POST, parent::getResourceKey());
		$this->refresh($result);
		
		return $this;
	}
	
	private static function getUrl($id = '') {
		return OMISE_API_URL.self::ENDPOINT.'/'.$id;
	}
}