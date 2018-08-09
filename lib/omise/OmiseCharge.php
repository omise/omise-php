<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseCharge extends OmiseApiResource
{
    const ENDPOINT = 'charges';

    /**
     * Retrieves a charge.
     *
     * @param  string $id
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseCharge
     */
    public static function retrieve($id = '', $publicKey = null, $secretKey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id), $publicKey, $secretKey);
    }

    /**
     * Search for charges.
     *
     * @param  string $query
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseSearch
     */
    public static function search($query = '', $publicKey = null, $secretKey = null)
    {
        return OmiseSearch::scope('charge', $publicKey, $secretKey)->query($query);
    }

    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::g_reload()
     * @throws Exceptions\OmiseException
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
     * @param  array $params
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseCharge
     * @throws Exceptions\OmiseException
     */
    public static function create($params, $publicKey = null, $secretKey = null)
    {
        return parent::g_create(get_class(), self::getUrl(), $params, $publicKey, $secretKey);
    }

    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::g_update()
     * @param $params
     * @throws Exceptions\OmiseException
     */
    public function update($params)
    {
        parent::g_update(self::getUrl($this['id']), $params);
    }

    /**
     * Captures a charge.
     *
     * @return OmiseCharge
     * @throws Exceptions\OmiseAuthenticationFailureException
     * @throws Exceptions\OmiseException
     * @throws Exceptions\OmiseFailedCaptureException
     * @throws Exceptions\OmiseFailedFraudCheckException
     * @throws Exceptions\OmiseInvalidCardException
     * @throws Exceptions\OmiseInvalidCardTokenException
     * @throws Exceptions\OmiseInvalidChargeException
     * @throws Exceptions\OmiseMissingCardException
     * @throws Exceptions\OmiseNotFoundException
     * @throws Exceptions\OmiseUndefinedException
     * @throws Exceptions\OmiseUsedTokenException
     */
    public function capture()
    {
        $result = parent::execute(self::getUrl($this['id']) . '/capture', parent::REQUEST_POST, parent::getResourceKey());
        $this->refresh($result);

        return $this;
    }

    /**
     * Reverses a charge.
     *
     * @return OmiseCharge
     * @throws Exceptions\OmiseAuthenticationFailureException
     * @throws Exceptions\OmiseException
     * @throws Exceptions\OmiseFailedCaptureException
     * @throws Exceptions\OmiseFailedFraudCheckException
     * @throws Exceptions\OmiseInvalidCardException
     * @throws Exceptions\OmiseInvalidCardTokenException
     * @throws Exceptions\OmiseInvalidChargeException
     * @throws Exceptions\OmiseMissingCardException
     * @throws Exceptions\OmiseNotFoundException
     * @throws Exceptions\OmiseUndefinedException
     * @throws Exceptions\OmiseUsedTokenException
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
     * @throws Exceptions\OmiseAuthenticationFailureException
     * @throws Exceptions\OmiseException
     * @throws Exceptions\OmiseFailedCaptureException
     * @throws Exceptions\OmiseFailedFraudCheckException
     * @throws Exceptions\OmiseInvalidCardException
     * @throws Exceptions\OmiseInvalidCardTokenException
     * @throws Exceptions\OmiseInvalidChargeException
     * @throws Exceptions\OmiseMissingCardException
     * @throws Exceptions\OmiseNotFoundException
     * @throws Exceptions\OmiseUndefinedException
     * @throws Exceptions\OmiseUsedTokenException
     */
    public function refunds()
    {
        $result = parent::execute(self::getUrl($this['id']) . '/refunds', parent::REQUEST_GET, parent::getResourceKey());

        return new OmiseRefundList($result, $this['id'], $this->_publicKey, $this->_secretKey);
    }

    /**
     * Gets a list of charge schedules.
     *
     * @param  array|string $options
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    public static function schedules($options = array(), $publicKey = null, $secretKey = null)
    {
        if (is_array($options)) {
            $options = '?' . http_build_query($options);
        }

        return parent::g_retrieve('OmiseScheduleList', self::getUrl('schedules' . $options), $publicKey, $secretKey);
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
