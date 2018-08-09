<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseSource extends OmiseApiResource
{
    const ENDPOINT = 'sources';

    /**
     * Creates a new source.
     *
     * @param  array $params
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     * @throws Exceptions\OmiseException
     */
    public static function create($params, $publicKey = null, $secretKey = null)
    {
        return parent::g_create(get_class(), self::getUrl(), $params, $publicKey, $secretKey);
    }

    /**
     * @return string
     */
    private static function getUrl()
    {
        return OMISE_API_URL . self::ENDPOINT;
    }
}
