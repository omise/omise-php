<?php

namespace Omise\OmisePHP;

use Omise\OmisePHP\Res\OmiseApiResource;
use Omise\OmisePHP\Res\Obj\OmiseCardList;

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
    return parent::retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
  }

  /**
   * Creates a new customer.
   * @param array $params
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseCustomer
   */
  public static function create($params, $publickey = null, $secretkey = null) {
    return parent::create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::reload()
   */
  public function reload() {
    if($this['object'] === 'customer') {
      parent::reload(self::getUrl($this['id']));
    } else {
      parent::reload(self::getUrl());
    }
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::update()
   */
  public function update($params) {
    parent::update(self::getUrl($this['id']), $params);
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::destroy()
   */
  public function destroy() {
    parent::destroy(self::getUrl($this['id']));
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
  public function getCards() {
    if($this['object'] === 'customer') {
      return new OmiseCardList($this, $this->_publickey, $this->_secretkey);
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
