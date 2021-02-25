<?php

class OmiseSchedule extends OmiseApiResource
{
    const ENDPOINT = 'schedules';

    /**
     * Retrieves a schedule.
     *
     * @param  string $id
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseSchedule
     */
    public static function retrieve($id = '', $publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
    }

    /**
     * Reloads the schedule.
     */
    public function reload()
    {
        if ($this['object'] === 'schedule') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
    }

    /**
     * Creates a new schedule.
     *
     * @param  array  $params
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseSchedule
     */
    public static function create($params, $publickey = null, $secretkey = null)
    {
        return parent::g_create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
    }

    /**
     * Lists occurrences of the schedule.
     *
     * @param  array|string $options
     *
     * @return OmiseOccurrenceList
     */
    public function occurrences($options = array())
    {
        return parent::g_list('OmiseOccurrenceList', self::getUrl($this['id'] . '/occurrences'), $options, $this->_publickey, $this->_secretkey);
    }

    /**
     * Destroys the schedule.
     */
    public function destroy()
    {
        parent::g_destroy($this->getUrl($this['id']));
    }

    /**
     * Checks whether the schedule has been destroyed.
     *
     * @return bool
     */
    public function isDestroyed()
    {
        return parent::isDestroyed();
    }

    /**
     * Generates a request URL.
     *
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }
}
