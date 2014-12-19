<?php
require_once dirname(__FILE__).'/OmiseResource.php';

class OmiseResourceSingleton extends OmiseResource {
	public $test = 0;
	private static $_instance = null;
	
	public function upTest() {
		$this->test = 100;
	}
	public function getTest() {
		return $this->test;
	}
	
	/**
	 * 
	 * @param string $clazz
	 * @param string $secretkey
	 * @param string $publickey
	 * @throws Exception
	 * @return OmiseResourceSingleton
	 */
	protected static function getInstance($clazz, $publickey, $secretkey) {
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
