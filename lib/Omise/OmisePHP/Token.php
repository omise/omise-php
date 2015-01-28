<?php

namespace Omise\OmisePHP;

use Omise\OmisePHP\Res\OmiseVaultResource;

class Token extends OmiseVaultResource {
  const ENDPOINT = 'tokens';

  /**
   * Retrieves a token.
   * @param string $id
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseToken
   */
  public static function retrieve($id, $publickey = null, $secretkey = null) {
    return parent::retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
  }

  /**
   * Creates a new token. Please note that this method should be used only
   * in development. In production please use Omise.js!
   * @param array $params
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseToken
   */
  public static function create($params, $publickey = null, $secretkey = null) {
    return parent::create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::reload()
   */
  public function reload() {
    parent::reload(self::getUrl($this['id']));
  }

  /**
   *
   * @param string $id
   * @return string
   */
  private static function getUrl($id = '') {
    return OMISE_VAULT_URL.self::ENDPOINT.'/'.$id;
  }
}
