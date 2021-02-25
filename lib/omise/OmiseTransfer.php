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
        return parent::g_retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
    }

    /**
     * Searches for transfers.
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
     * Schedules a transfer.
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
        return parent::g_create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
    }

    /**
     * Reloads a transfer.
     */
    public function reload()
    {
        if ($this['object'] === 'transfer') {
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
        $this->update(array('amount' => $this['amount']));
    }

    /**
     * Updates the transfer.
     *
     * @param  array  $params
     */
    public function update($params)
    {
        parent::g_update(self::getUrl($this['id']), $params);
    }

    /**
     * Lists transfer schedules.
     *
     * @param  array|string $options
     * @param  string       $publickey
     * @param  string       $secretkey
     *
     * @return OmiseScheduleList
     */
    public static function schedules($options = array(), $publickey = null, $secretkey = null)
    {
        return parent::g_list('OmiseScheduleList', self::getUrl('schedules'), $options, $publickey, $secretkey);
    }

    /**
     * Destroys the transfer.
     */
    public function destroy()
    {
        parent::g_destroy($this->getUrl($this['id']));
    }

    /**
     * Checks whether the transfer has been destroyed.
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
