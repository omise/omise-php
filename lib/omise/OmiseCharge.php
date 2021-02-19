<?php

class OmiseCharge extends OmiseApiResource
{
    const ENDPOINT = 'charges';

    /**
     * Retrieves a charge.
     *
     * @param  string $id
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseCharge
     */
    public static function retrieve($id = '', $publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
    }

    /**
     * Searches for charges.
     *
     * @param  string $query
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseSearch
     */
    public static function search($query = '', $publickey = null, $secretkey = null)
    {
        return OmiseSearch::scope('charge', $publickey, $secretkey)->query($query);
    }

    /**
     * Reloads the charge.
     */
    public function reload()
    {
        if ($this['object'] === 'charge') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
    }

    /**
     * Schedules a charge.
     *
     * @param  string $params
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseScheduler
     */
    public static function schedule($params, $publickey = null, $secretkey = null)
    {
        return new OmiseScheduler('charge', $params, $publickey, $secretkey);
    }

    /**
     * Creates a new charge.
     *
     * @param  array  $params
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseCharge
     */
    public static function create($params, $publickey = null, $secretkey = null)
    {
        return parent::g_create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
    }

    /**
     * Updates the charge.
     *
     * @param  array  $params
     */
    public function update($params)
    {
        parent::g_update(self::getUrl($this['id']), $params);
    }

    /**
     * Sets the charge to expire.
     */
    public function expire()
    {
        parent::g_process(self::getUrl($this['id']) . '/expire');
    }

    /**
     * Captures the charge.
     */
    public function capture()
    {
        parent::g_process(self::getUrl($this['id']) . '/capture');
    }

    /**
     * Refunds the charge.
     *
     * @param  array  $params
     *
     * @return OmiseRefund
     */
    public function refund($params)
    {
        $result = parent::execute(self::getUrl($this['id']) . '/refunds', parent::REQUEST_POST, parent::getResourceKey(), $params);
        return new OmiseRefund($result, $this->_publickey, $this->_secretkey);
    }

    /**
     * Reverses the charge.
     */
    public function reverse()
    {
        parent::g_process(self::getUrl($this['id']) . '/reverse');
    }

    /**
     * Lists refunds of the charge.
     *
     * @param  array|string $options
     *
     * @return OmiseRefundList
     */
    public function refunds($options = array())
    {
        if (is_array($options) && ! empty($options)) {
            $refunds = parent::execute(self::getUrl($this['id']) . '/refunds?' . http_build_query($options), parent::REQUEST_GET, parent::getResourceKey());
        } else {
            $refunds = $this['refunds'];
        }

        return new OmiseRefundList($refunds, $this['id'], $this->_publickey, $this->_secretkey);
    }

    /**
     * Lists charge schedules.
     *
     * @param  array|string $options
     * @param  string       $publickey
     * @param  string       $secretkey
     *
     * @return OmiseScheduleList
     */
    public static function schedules($options = array(), $publickey = null, $secretkey = null)
    {
        if (is_array($options)) {
            $options = '?' . http_build_query($options);
        }

        return parent::g_retrieve('OmiseScheduleList', self::getUrl('schedules' . $options), $publickey, $secretkey);
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
