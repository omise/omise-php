<?php
namespace Omise;

use Omise\Res\OmiseApiResource;
use Omise\Occurrence;

class OccurrenceList extends OmiseApiResource
{
    /**
     * @param  string $id
     *
     * @return Omise\Occurrence
     */
    public function retrieve($id)
    {
        return Occurrence::retrieve($id);
    }
}
