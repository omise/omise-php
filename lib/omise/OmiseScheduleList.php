<?php

class OmiseScheduleList extends OmiseApiResource
{
    /**
     * Retrieves a schedule.
     *
     * @param  string $id
     *
     * @return OmiseSchedule
     */
    public function retrieve($id)
    {
        return OmiseSchedule::retrieve($id, $this->_publickey, $this->_secretkey);
    }
}
