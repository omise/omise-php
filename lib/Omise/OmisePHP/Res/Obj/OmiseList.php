<?php

namespace Omise\OmisePHP\Res\Obj;

require_once dirname(__FILE__).'/OmiseObject.php';

class OmiseList extends OmiseObject {
  /**
   * getInstanceせずにインスタンス生成可能にする
   * @param string $publickey
   * @param string $secretkey
   */
  public function __construct($publickey = null, $secretkey = null) {
    parent::__construct($publickey, $secretkey);
  }
}