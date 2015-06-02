<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseRecipient extends OmiseApiResource {
  const ENDPOINT = 'recipients';

  /**
   * Retrieves a recipient.
   * @param string $id
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseRecipient
   */
  public static function retrieve($id = '', $publickey = null, $secretkey = null) {
    return parent::g_retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
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
