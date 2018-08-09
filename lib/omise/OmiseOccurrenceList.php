<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseOccurrenceList extends OmiseApiResource
{
    /**
     * @param  string $id
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    public function retrieve($id)
    {
        return OmiseOccurrence::retrieve($id, $this->_publicKey, $this->_secretKey);
    }
}
