<?php
require_once dirname(__FILE__).'/res/OmiseApiResource.php';
require_once dirname(__FILE__).'/OmiseCardList.php';

class OmiseCustomers extends OmiseApiResource {
	const ENDPOINT = 'customers';
	
	public static function retrive($id = '', $publickey = null, $secretkey = null) {
		return parent::retrive(get_class(), self::getUrl($id), $publickey, $secretkey);
	}
	
	public static function create($params, $publickey = null, $secretkey = null) {
		return parent::create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
	}
	
	public function reload() {
		if($this['object'] === 'customer') {
			parent::reload(self::getUrl($this['id']));
		} else {
			parent::reload(self::getUrl());
		}
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
	
	public function getCards() {
		return new OmiseCardList($this['data'], $this->_publickey, $this->_secretkey);
	}
	
	private static function getUrl($id = '') {
		return OMISE_API_URL.self::ENDPOINT.'/'.$id;
	}
}