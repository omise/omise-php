<?php
require_once dirname(__FILE__).'/res/OmiseApiResource.php';
require_once dirname(__FILE__).'/OmiseCustomers.php';

class OmiseCards extends OmiseApiResource {
	private $_customerID;
	const ENDPOINT = 'cards';
	
	public function __construct($array, $customerID, $publickey = null, $secretkey = null) {
		parent::__construct($publickey, $secretkey);
		$this->_customerID = $customerID;
		$this->refresh($array);
	}

	public function reload() {
		parent::reload($this->getUrl($this['id']));
	}

	public function update($params) {
		return parent::update($this->getUrl($this['id']), $params);
	}

	private function getUrl($cardID = '') {
		return OMISE_API_URL.OmiseCustomers::ENDPOINT.'/'.$this->_customerID.'/'.self::ENDPOINT.'/'.$cardID;
	}
}