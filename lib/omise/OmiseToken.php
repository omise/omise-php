<?php
require_once dirname(__FILE__).'/res/OmiseVaultResource.php';

class OmiseToken extends OmiseVaultResource {
	const ENDPOINT = 'tokens';
	
	/**
	 * 
	 * @param string $id
	 * @param string $publickey
	 * @param string $secretkey
	 * @return OmiseToken
	 */
	public static function retrieve($id, $publickey = null, $secretkey = null) {
		return parent::retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
	}
	
	/**
	 * 
	 * @param array $params
	 * @param string $publickey
	 * @param string $secretkey
	 * @return OmiseToken
	 */
	public static function create($params, $publickey = null, $secretkey = null) {
		return parent::create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see OmiseApiResource::reload()
	 */
	public function reload() {
		parent::reload(self::getUrl($this['id']));
	}
	
	/**
	 * 
	 * @param string $id
	 * @return string
	 */
	private static function getUrl($id = '') {
		return OMISE_VAULT_URL.self::ENDPOINT.'/'.$id;
	}
}