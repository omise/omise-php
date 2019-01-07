<?php
namespace Omise;

use Omise\Res\OmiseApiResource;
use Omise\Occurrence;

class OccurrenceList extends OmiseApiResource
{
    /**
     * @param  string $id
     *
     * @return OmiseOccurrence
     */
    public function retrieve($id)
    {
        return Occurrence::retrieve($id, $this->_publickey, $this->_secretkey);
    }
}
