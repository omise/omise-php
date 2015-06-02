<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseRefund extends OmiseApiResource {
  /**
   * @param array $refund
   * @param string $publickey
   * @param string $secretkey
   */
  public function __construct($refund, $publickey = null, $secretkey = null) {
    parent::__construct($publickey, $secretkey);
    $this->refresh($refund);
  }
}
