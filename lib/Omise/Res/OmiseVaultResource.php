<?php

namespace Omise\Res;

use Omise\Res\OmiseApiResource;

class OmiseVaultResource extends OmiseApiResource {
  /**
   * Returns the public key.
   * @return string
   */
  protected function getResourceKey() {
    return $this->_publickey;
  }
}
