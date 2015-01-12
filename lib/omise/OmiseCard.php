<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';
require_once dirname(__FILE__).'/OmiseCustomer.php';

class OmiseCard extends OmiseApiResource {
  private $_customerID;
  const ENDPOINT = 'cards';

  /**
   * Object representing a card. Cards are retrieved using a `Customer`.
   * @param array $array
   * @param string $customerID
   * @param string $publickey
   * @param string $secretkey
   */
  public function __construct($array, $customerID, $publickey = null, $secretkey = null) {
    parent::__construct($publickey, $secretkey);
    $this->_customerID = $customerID;
    $this->refresh($array);
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::reload()
   */
  public function reload() {
    parent::reload($this->getUrl($this['id']));
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::update()
   */
  public function update($params) {
    parent::update($this->getUrl($this['id']), $params);
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::destroy()
   */
  public function destroy() {
    parent::destroy($this->getUrl($this['id']));
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::isDestroyed()
   */
  public function isDestroyed() {
    return parent::isDestroyed();
  }

  /**
   *
   * @param string $cardID
   * @return string
   */
  private function getUrl($cardID = '') {
    return OMISE_API_URL.OmiseCustomers::ENDPOINT.'/'.$this->_customerID.'/'.self::ENDPOINT.'/'.$cardID;
  }
}
