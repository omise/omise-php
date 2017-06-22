<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';

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
