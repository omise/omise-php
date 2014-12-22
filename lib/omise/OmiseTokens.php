<?php
require_once dirname(__FILE__).'/res/OmiseVaultResource.php';

class OmiseTokens extends OmiseVaultResource {
	const ENDPOINT = 'tokens';
	
	/**
	 * 
	 * @param string $id
	 * @param string $publickey
	 * @param string $secretkey
	 * @return Ambigous <OmiseAccount, OmiseBalance>
	 */
	public static function retrieve($id, $publickey = null, $secretkey = null) {
		return parent::retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
	}
	
	public static function create($params, $publickey = null, $secretkey = null) {
		return parent::create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
	}
	
	public function reload() {
		parent::reload(self::getUrl($this['id']));
	}
	
	private static function getUrl($id = '') {
		return OMISE_VAULT_URL.self::ENDPOINT.'/'.$id;
	}
}