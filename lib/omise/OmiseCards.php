<?php
require_once dirname(__FILE__).'/resource/OmiseApiResource.php';

class OmiseCards extends OmiseApiResource {
	protected $_endpoint = 'tokens';
	
	/**
	 * 
	 * @param string $id
	 * @param string $publickey
	 * @param string $secretkey
	 * @return Ambigous <OmiseAccount, OmiseBalance>
	 */
	public static function retrive($id, $publickey = null, $secretkey = null) {
		return parent::retrive(get_class(), $publickey, $secretkey);
	}
	
	public static function create($params, $publickey = null, $secretkey = null) {
		return parent::create(get_class(), $params, $publickey, $secretkey);
	}
}