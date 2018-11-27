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
        return parent::g_create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
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
     * Captures a charge.
     *
     * @return OmiseCharge
     */
    public function capture()
    {
        $result = $this->apiRequestor->post(self::getUrl($this['id']).'/capture', parent::getResourceKey());
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
        $result = $this->apiRequestor->post(self::getUrl($this['id']) . '/refunds', parent::getResourceKey(), $params);
        return new OmiseRefund($result, $this->_publickey, $this->_secretkey);
    }

    /**
     * Reverses a charge.
     *
     * @return OmiseCharge
     */
    public function reverse()
    {
        $result = $this->apiRequestor->post(self::getUrl($this['id']).'/reverse', parent::getResourceKey());
        $this->refresh($result);

        return $this;
    }

    /**
     * list refunds
     *
     * @return OmiseRefundList
     */
    public function refunds()
    {
        $result = $this->apiRequestor->get(self::getUrl($this['id']).'/refunds', parent::getResourceKey());

        return new OmiseRefundList($result, $this['id'], $this->_publickey, $this->_secretkey);
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
    public static function schedules($options = array(), $publickey = null, $secretkey = null)
    {
        if (is_array($options)) {
            $options = '?' . http_build_query($options);
        }

        return parent::g_retrieve('OmiseScheduleList', self::getUrl('schedules' . $options), $publickey, $secretkey);
    }

    /**
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return \Omise\ApiRequestor::OMISE_API_URL.self::ENDPOINT.'/'.$id;
    }
}
