<?php

class OmiseOccurrenceList extends OmiseApiResource
{
    /**
     * Retrieves an occurence.
     *
     * @param  string $id
     *
     * @return OmiseOccurrence
     */
    public function retrieve($id)
    {
        return OmiseOccurrence::retrieve($id, $this->_publickey, $this->_secretkey);
    }
}
