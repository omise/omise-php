<?php

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
