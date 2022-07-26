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
     * @return void
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
     * @param  array|string $options
     *
     * @return OmiseOccurrenceList|null
     */
    public function occurrences($options = array())
    {
        if ($this['object'] === 'schedule') {
            if (is_array($options)) {
                $options = '?' . http_build_query($options);
            }

            return parent::g_retrieve('OmiseOccurrenceList', self::getUrl($this['id'] . '/occurrences' . $options), $this->_publickey, $this->_secretkey);
        }
    }

    /**
     * @return void
     */
    public function destroy()
    {
        parent::g_destroy(self::getUrl($this['id']));
    }

    /**
     * @return bool
     *
     * @see    OmiseApiResource::isDestroyed()
     */
    public function isDestroyed()
    {
        return parent::isDestroyed();
    }

    /**
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return OMISE_API_URL.self::ENDPOINT . '/' . $id;
    }
}
