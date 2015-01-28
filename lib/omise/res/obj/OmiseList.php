<?php

namespace Omise\Res\Obj;

use Omise\Res\Obj\OmiseObject;

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