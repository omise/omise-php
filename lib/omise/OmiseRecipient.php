<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseRecipient extends OmiseApiResource {
  const ENDPOINT = 'recipients';

  /**
   * Retrieves recipients.
   * @param string $id
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseRecipient
   */
  public static function retrieve($id = '', $publickey = null, $secretkey = null) {
    return parent::g_retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
  }

  /**
   * Creates a new recipient.
   * @param array $params
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseRecipient
   */
  public static function create($params, $publickey = null, $secretkey = null) {
    return parent::g_create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
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
