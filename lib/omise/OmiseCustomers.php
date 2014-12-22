<?php
require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseCustomers extends OmiseApiResource {
	const ENDPOINT = 'customers';
	
	public static function retrive($id = '', $publickey = null, $secretkey = null) {
		return parent::retrive(get_class(), self::getUrl($id), $publickey, $secretkey);
	}
	
	public static function create($params, $publickey = null, $secretkey = null) {
		return parent::create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
	}
	
	public function update($params) {
		return parent::update(self::getUrl($this['id']), $params);
	}
	
	public function destroy() {
		return parent::destroy(self::getUrl($this['id']));
	}
	
	public function isDestroyed() {
		return $this['deleted'];
	}
	
// 	public function capture() {
// 		$result = parent::execute(self::getUrl($this['id']).'/capture', parent::REQUEST_POST, parent::getResourceKey());
// 		$this->refresh($result);
	
// 		return $this;
// 	}
	
	private static function getUrl($id = '') {
		return OMISE_API_URL.self::ENDPOINT.'/'.$id;
	}
	
}