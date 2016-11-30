<?php

require_once dirname(__FILE__).'/OmiseApiResource.php';

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
class OmiseVaultResource extends OmiseApiResource
{
    /**
     * Returns the public key.
     *
     * @return string
     */
    protected function getResourceKey()
    {
        return $this->_publickey;
    }
}
