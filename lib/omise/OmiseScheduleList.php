<?php

class OmiseScheduleList extends OmiseApiResource
{
    /**
     * @param  string $id
     *
     * @return OmiseOccurrence
     */
    public function retrieve($id)
    {
        return OmiseSchedule::retrieve($id, $this->_publickey, $this->_secretkey);
    }
}
