<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseDispute extends OmiseApiResource {
  const ENDPOINT = 'disputes';

  /**
   * Retrieves a dispute.
   * @param string $id
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseCustomer
   */
  public static function retrieve($id = '', $publickey = null, $secretkey = null) {
    return parent::g_retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::g_update()
   */
  public function update($params) {
    parent::g_update(self::getUrl($this['id']), $params);
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
