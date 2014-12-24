<?php
require_once dirname(__FILE__).'/res/OmiseApiResource.php';
require_once dirname(__FILE__).'/OmiseCustomers.php';

class OmiseCards extends OmiseApiResource {
	private $_customerID;
	const ENDPOINT = 'cards';
	
	/**
	 * Cardsは直接retriveしに行かずにコンストラクタでcards arrayを受け取る
	 * @param array $array
	 * @param string $customerID
	 * @param string $publickey
	 * @param string $secretkey
	 */
	public function __construct($array, $customerID, $publickey = null, $secretkey = null) {
		parent::__construct($publickey, $secretkey);
		$this->_customerID = $customerID;
		$this->refresh($array);
	}

	/**
	 * (non-PHPdoc)
	 * @see OmiseApiResource::reload()
	 */
	public function reload() {
		parent::reload($this->getUrl($this['id']));
	}

	/**
	 * (non-PHPdoc)
	 * @see OmiseApiResource::update()
	 */
	public function update($params) {
		parent::update($this->getUrl($this['id']), $params);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see OmiseApiResource::destroy()
	 */
	public function destroy() {
		parent::destroy($this->getUrl($this['id']));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see OmiseApiResource::isDestroyed()
	 */
	public function isDestroyed() {
		return parent::isDestroyed();
	}

	/**
	 * URLを作る
	 * @param string $cardID
	 * @return string
	 */
	private function getUrl($cardID = '') {
		return OMISE_API_URL.OmiseCustomers::ENDPOINT.'/'.$this->_customerID.'/'.self::ENDPOINT.'/'.$cardID;
	}
}