<?php
namespace Omise;

use Omise\Res\OmiseApiResource;
use Omise\Schedule;

class ScheduleList extends OmiseApiResource
{
    /**
     * @param  string $id
     *
     * @return Omise\Occurrence
     */
    public function retrieve($id)
    {
        return Schedule::retrieve($id);
    }
}
