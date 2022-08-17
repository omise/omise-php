<?php

class OmiseRecipient extends OmiseApiResource
{
    const ENDPOINT = 'recipients';

    /**
     * Retrieves recipients.
     *
     * @param  string $id
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseRecipient
     */
    public static function retrieve($id = '', $publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(self::getUrl($id), $publickey, $secretkey);
    }

    /**
     * Search for recipients.
     *
     * @param  string $query
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseSearch
     */
    public static function search($query = '', $publickey = null, $secretkey = null)
    {
        return OmiseSearch::scope('recipient', $publickey, $secretkey)->query($query);
    }

    /**
     * Creates a new recipient.
     *
     * @param  array  $params
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseRecipient
     */
    public static function create($params, $publickey = null, $secretkey = null)
    {
        return parent::g_create(self::getUrl(), $params, $publickey, $secretkey);
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_update()
     */
    public function update($params)
    {
        parent::g_update(self::getUrl($this['id']), $params);
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_destroy()
     */
    public function destroy()
    {
        parent::g_destroy(self::getUrl($this['id']));
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::isDestroyed()
     */
    public static function isDestroyed()
    {
        return parent::isDestroyed();
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_reload()
     */
    public function reload()
    {
        if ($this['object'] === 'recipient') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
    }

    /**
     * Gets a list of transfer schedules that belongs to a given recipient.
     *
     * @param  array|string $options
     *
     * @return OmiseScheduleList|null
     */
    public function schedules($options = [])
    {
        if ($this['object'] === 'recipient') {
            if (is_array($options)) {
                $options = '?' . http_build_query($options);
            }

            return OmiseScheduleList::g_retrieve(self::getUrl($this['id'] . '/schedules' . $options), $this->_publickey, $this->_secretkey);
        }
    }

    /**
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }
}
