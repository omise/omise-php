<?php
require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseTransfer extends OmiseApiResource {
	const ENDPOINT = 'transfers';
	
	/**
	 * 
	 * @param string $id
	 * @param string $publickey
	 * @param string $secretkey
	 * @return OmiseTransfer
	 */
	public static function retrieve($id = '', $publickey = null, $secretkey = null) {
		return parent::retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
	}
	
	/**
	 * 
	 * @param unknown $params
	 * @param string $publickey
	 * @param string $secretkey
	 * @return OmiseTransfer
	 */
	public static function create($params, $publickey = null, $secretkey = null) {
		return parent::create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
	}

	/**
	 * (non-PHPdoc)
	 * @see OmiseApiResource::reload()
	 */
	public function reload() {
		if($this['object'] === 'transfers') {
			parent::reload(self::getUrl($this['id']));
		} else {
			parent::reload(self::getUrl());
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see OmiseApiResource::update()
	 */
	public function update($params) {
		parent::update(self::getUrl($this['id']), $params);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see OmiseApiResource::destroy()
	 */
	public function destroy() {
		parent::destroy(self::getUrl($this['id']));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see OmiseApiResource::isDestroyed()
	 */
	public function isDestroyed() {
		return parent::isDestroyed();
	}
	
	/**
	 * 
	 * @param string $id
	 * @return string
	 */
	private static function getUrl($id = '') {
		return OMISE_API_URL.self::ENDPOINT.'/'.$id;
	}
}