<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseScheduleList extends OmiseApiResource
{
    /**
     * @param  string $id
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
	public function retrieve($id)
	{
	    return OmiseSchedule::retrieve($id, $this->_publicKey, $this->_secretKey);
	}
}
