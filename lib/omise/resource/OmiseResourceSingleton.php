<?php
require_once dirname(__FILE__).'/OmiseResource.php';

class OmiseResourceSingleton extends OmiseResource {
	private static $_instance = null;
	
	protected static function getInstance($clazz, $secretkey, $publickey) {
		if(self::$_instance === null) {
			if(class_exists($class_name)) {
				self::$_instance = new $clazz($secretkey, $publickey);
			} else {
				throw new Exception('Undefined class.');
			}
		}
	
		return self::$_instance;
	}
}