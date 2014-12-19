<?php
require_once dirname(__FILE__).'/OmiseResource.php';

class OmiseResourceSingleton extends OmiseResource {
	private static $_instance = null;
	
	/**
	 * 
	 * @param string $clazz
	 * @param string $secretkey
	 * @param string $publickey
	 * @throws Exception
	 * @return OmiseResourceSingleton
	 */
	protected static function getInstance($clazz, $publickey = null, $secretkey = null) {
		if(self::$_instance === null) {
			if(class_exists($clazz)) {
				self::$_instance = new $clazz($publickey, $secretkey);
			} else {
				throw new Exception('Undefined class.');
			}
		}
	
		return self::$_instance;
	}
}
