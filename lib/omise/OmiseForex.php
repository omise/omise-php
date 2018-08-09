<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseForex extends OmiseApiResource
{
    const ENDPOINT = 'forex';

    /**
     * Retrieves a forex data.
     *
     * @param  string $currency
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    public static function retrieve($currency = '', $publicKey = null, $secretKey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($currency), $publicKey, $secretKey);
    }

    /**
     * @see OmiseApiResource::g_reload()
     * @throws Exceptions\OmiseException
     */
    public function reload()
    {
        parent::g_reload(self::getUrl($this['from']));
    }

    /**
     * @param  string $currency
     *
     * @return string
     */
    private static function getUrl($currency = '')
    {
        return OMISE_API_URL . self::ENDPOINT . '/' . $currency;
    }
}
