<?php

class OmiseTransfer extends OmiseApiResource
{
    const ENDPOINT = 'transfers';

    /**
     * Retrieves a transfer.
     *
     * @param  string $id
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseTransfer
     */
    public static function retrieve($id = '', $publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(self::getUrl($id), $publickey, $secretkey);
    }

    /**
     * Search for transfers.
     *
     * @param  string $query
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseSearch
     */
    public static function search($query = '', $publickey = null, $secretkey = null)
    {
        return OmiseSearch::scope('transfer', $publickey, $secretkey)->query($query);
    }

    /**
     * Schedule a transfer.
     *
     * @param  string $params
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseScheduler
     */
    public static function schedule($params, $publickey = null, $secretkey = null)
    {
        return new OmiseScheduler('transfer', $params, $publickey, $secretkey);
    }

    /**
     * Creates a transfer.
     *
     * @param  mixed  $params
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseTransfer
     */
    public static function create($params, $publickey = null, $secretkey = null)
    {
        return parent::g_create(self::getUrl(), $params, $publickey, $secretkey);
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_reload()
     */
    public function reload()
    {
        if ($this['object'] === 'transfers') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
    }

    /**
     * Updates the transfer amount.
     */
    public function save()
    {
        $this->update(['amount' => $this['amount']]);
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_update()
     */
    protected function update($params)
    {
        parent::g_update(self::getUrl($this['id']), $params);
    }

    /**
     * Gets a list of transfer schedules.
     *
     * @param  array|string $options
     * @param  string       $publickey
     * @param  string       $secretkey
     *
     * @return OmiseScheduleList
     */
    public static function schedules($options = [], $publickey = null, $secretkey = null)
    {
        if (is_array($options)) {
            $options = '?' . http_build_query($options);
        }

        return OmiseScheduleList::g_retrieve(self::getUrl('schedules' . $options), $publickey, $secretkey);
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
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }
}
