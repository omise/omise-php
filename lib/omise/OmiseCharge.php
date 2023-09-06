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
        return parent::g_retrieve(self::getUrl($id), $publickey, $secretkey);
    }

    /**
     * Search for charges.
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
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_reload()
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
     * Schedule a charge.
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
     * @see OmiseApiResource::g_expire()
     */
    public function expire()
    {
        parent::g_expire(self::getUrl($this['id']) . '/expire');
    }

    /**
     * Captures a charge.
     *
     * @param  array  $params
     * @return OmiseCharge
     */
    public function capture($params = null)
    {
        $result = parent::execute(self::getUrl($this['id']) . '/capture', parent::REQUEST_POST, parent::getResourceKey(), $params);
        $this->refresh($result);

        return $this;
    }

    /**
     * Refund a charge.
     *
     * @return OmiseRefund
     */
    public function refund($params)
    {
        $result = parent::execute(self::getUrl($this['id']) . '/refunds', parent::REQUEST_POST, parent::getResourceKey(), $params);

        return new OmiseRefund($result, $this->_publickey, $this->_secretkey);
    }

    /**
     * Reverses a charge.
     *
     * @return OmiseCharge
     */
    public function reverse()
    {
        $result = parent::execute(self::getUrl($this['id']) . '/reverse', parent::REQUEST_POST, parent::getResourceKey());
        $this->refresh($result);

        return $this;
    }

    /**
     * list refunds
     *
     * @return OmiseRefundList
     */
    public function refunds($options = [])
    {
        if (is_array($options) && ! empty($options)) {
            $refunds = parent::execute(self::getUrl($this['id']) . '/refunds?' . http_build_query($options), parent::REQUEST_GET, parent::getResourceKey());
        } else {
            $refunds = $this['refunds'];
        }

        return new OmiseRefundList($refunds, $this['id'], $this->_publickey, $this->_secretkey);
    }

    /**
     * Gets a list of charge schedules.
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
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }
}
