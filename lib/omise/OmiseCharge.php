<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';
require_once dirname(__FILE__).'/OmiseRefundList.php';

class OmiseCharge extends OmiseApiResource {
  const ENDPOINT = 'charges';

  /**
   * Retrieves a charge.
   * @param string $id
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseCharge
   */
  public static function retrieve($id = '', $publickey = null, $secretkey = null) {
    return parent::g_retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::g_reload()
   */
  public function reload() {
    if($this['object'] === 'charge') {
      parent::g_reload(self::getUrl($this['id']));
    } else {
      parent::g_reload(self::getUrl());
    }
  }

  /**
   * Creates a new charge.
   * @param array $params
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseCharge
   */
  public static function create($params, $publickey = null, $secretkey = null) {
    return parent::g_create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::g_update()
   */
  public function update($params) {
    parent::g_update(self::getUrl($this['id']), $params);
  }

  /**
   * Captures a charge.
   * @return OmiseCharge
   */
  public function capture() {
    $result = parent::execute(self::getUrl($this['id']).'/capture', parent::REQUEST_POST, parent::getResourceKey());
    $this->refresh($result);

    return $this;
  }

  /**
   * list refunds
   * @param null|string $publickey
   * @param null|string $secretkey
   * @return OmiseRefundList
   * @throws Exception
   * @throws OmiseAuthenticationFailureException
   * @throws OmiseFailedCaptureException
   * @throws OmiseFailedFraudCheckException
   * @throws OmiseInvalidCardException
   * @throws OmiseInvalidCardTokenException
   * @throws OmiseInvalidChargeException
   * @throws OmiseMissingCardException
   * @throws OmiseNotFoundException
   * @throws OmiseUndefinedException
   * @throws OmiseUsedTokenException
   */
  public function refunds($publickey = null, $secretkey = null) {
    $result = parent::execute(self::getUrl($this['id']).'/refunds', parent::REQUEST_GET, parent::getResourceKey());
    return new OmiseRefundList($result, $this['id'], $publickey, $secretkey);
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
