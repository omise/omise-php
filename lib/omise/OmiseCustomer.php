<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';
require_once dirname(__FILE__).'/OmiseCardList.php';

class OmiseCustomer extends OmiseApiResource {
  const ENDPOINT = 'customers';

  /**
   * Retrieves a customer.
   * @param string $id
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseCustomer
   */
  public static function retrieve($id = '', $publickey = null, $secretkey = null) {
    return parent::g_retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
  }

  /**
   * Creates a new customer.
   * @param array $params
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseCustomer
   */
  public static function create($params, $publickey = null, $secretkey = null) {
    return parent::g_create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::g_reload()
   */
  public function reload() {
    if($this['object'] === 'customer') {
      parent::g_reload(self::getUrl($this['id']));
    } else {
      parent::g_reload(self::getUrl());
    }
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::g_update()
   */
  public function update($params) {
    parent::g_update(self::getUrl($this['id']), $params);
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::g_destroy()
   */
  public function destroy() {
    parent::g_destroy(self::getUrl($this['id']));
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::isDestroyed()
   */
  public function isDestroyed() {
    return parent::isDestroyed();
  }

  /**
   * Gets a list of all cards belongs to this customer.
   * @return OmiseCardList
   */
  public function cards($options = array()) {
    if($this['object'] === 'customer' &&  !empty($options)) {
      return new OmiseCardList($this['cards'], $this['id'], $options, $this->_publickey, $this->_secretkey);
    } else if ($this['object'] === 'customer') {
      return new OmiseCardList($this['cards'], $this['id'], $this->_publickey, $this->_secretkey);
    }
  }
  
  /**
   * cards() alias
   * @deprecated deprecated since version 2.0.0 use '$customer->cards()'
   * @return OmiseCardList
   */
  public function getCards($options = array()) {
    return $this->cards($options);
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
