<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';
require_once dirname(__FILE__).'/res/obj/OmiseRefundList.php';

class OmiseCharge extends OmiseApiResource {
  const ENDPOINT = 'charges';

  /**
   * Retrieves a charge.
   * @param string $id
   * @param string $publickey
   * @param string $secretkey
   * @return Charge
   */
  public static function retrieve($id = '', $publickey = null, $secretkey = null) {
    return parent::retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::reload()
   */
  public function reload() {
    if($this['object'] === 'charge') {
      parent::reload(self::getUrl($this['id']));
    } else {
      parent::reload(self::getUrl());
    }
  }

  /**
   * Creates a new charge.
   * @param array $params
   * @param string $publickey
   * @param string $secretkey
   * @return Charge
   */
  public static function create($params, $publickey = null, $secretkey = null) {
    return parent::create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::update()
   */
  public function update($params) {
    parent::update(self::getUrl($this['id']), $params);
  }

  /**
   * Captures a charge.
   * @return Charge
   */
  public function capture() {
    $result = parent::execute(self::getUrl($this['id']).'/capture', parent::REQUEST_POST, parent::getResourceKey());
    $this->refresh($result);

    return $this;
  }
  
  /**
   * refund
   * @return Refund
   */
  public function refunds() {
    return new OmiseRefundList(parent::execute(self::getUrl($this['id']).'/refunds', parent::REQUEST_GET, parent::getResourceKey()), 
    		$this->_publickey, $this->_secretkey);
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
