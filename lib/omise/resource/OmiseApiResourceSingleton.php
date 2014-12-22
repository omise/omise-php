<?php
require_once dirname(__FILE__).'/OmiseApiResource.php';

class OmiseApiResourceSingleton extends OmiseApiResource {
	private static $_instance = null;
	
	/**
	 * シングルトンインスタンスのためのインスタンス生成メソッド
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
	
	/**
	 * シングルトンリソースはretriveにIDを必要としないためオーバーライド
	 * @param string $clazz
	 * @param string $publickey
	 * @param string $secretkey
	 * @return unknown
	 */
	protected static function retrive($clazz, $publickey = null, $secretkey = null) {
		return parent::retrive($clazz, '', $publickey, $secretkey);
	}
	
	/**
	 * シングルトンリソースはreloadを許可する
	 * @see OmiseApiResource::reload()
	 */
	public function reload() {
		parent::reload();
	}
}
