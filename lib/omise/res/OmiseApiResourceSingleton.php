<?php

require_once dirname(__FILE__).'/OmiseApiResource.php';

class OmiseApiResourceSingleton extends OmiseApiResource {
  private static $_instance = null;

  /**
   * Returns an instance of the class given in $clazz as a singleton resource or raise an error.
   * @param string $clazz
   * @param string $publickey
   * @param string $secretkey
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
