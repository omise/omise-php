<?php

class OmiseForex extends OmiseApiResource
{
    const ENDPOINT = 'forex';

    /**
     * Retrieves the current foreign exchange rate.
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
     * Reloads the current foreign exchange rate.
     */
    public function reload()
    {
        parent::g_reload(self::getUrl($this['base']));
    }

    /**
     * Generates a request URL.
     *
     * @param  string $currency
     *
     * @return string
     */
    private static function getUrl($currency = '')
    {
        return OMISE_API_URL . self::ENDPOINT . '/' . $currency;
    }
}
