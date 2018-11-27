<?php

class OmiseForex extends OmiseApiResource
{
    const ENDPOINT = 'forex';

    /**
     * Retrieves a forex data.
     *
     * @param  string $currency
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseForex
     */
    public static function retrieve($currency = '', $publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($currency), $publickey, $secretkey);
    }

    /**
     * @param  string $currency
     *
     * @return string
     */
    private static function getUrl($currency = '')
    {
        return \Omise\ApiRequestor::OMISE_API_URL . self::ENDPOINT . '/' . $currency;
    }
}
