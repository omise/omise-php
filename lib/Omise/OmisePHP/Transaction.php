<?php

namespace Omise\OmisePHP;

use Omise\OmisePHP\Res\OmiseApiResource;

class Transaction extends OmiseApiResource {
  const ENDPOINT = 'transactions';

  /**
   * Retrieves a transaction.
   * @param string $id
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseTransaction
   */
  public static function retrieve($id = '', $publickey = null, $secretkey = null) {
    return parent::retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::reload()
   */
  public function reload() {
    if($this['object'] === 'transaction') {
      parent::reload(self::getUrl($this['id']));
    } else {
      parent::reload(self::getUrl());
    }
  }

  /**
   *
   * @param string $id
   * @return string
   */
  private static function getUrl($id = '') {
    return OMISE_API_URL.self::ENDPOINT.'/'.$id;
  }
}
