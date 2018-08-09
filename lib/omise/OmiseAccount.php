<?php

namespace Omise;

use Omise\Exceptions\OmiseException;
use Omise\Res\OmiseApiResource;

class OmiseAccount extends OmiseApiResource
{
    const ENDPOINT = 'account';

    /**
     * Retrieves an account.
     *
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    public static function retrieve($publicKey = null, $secretKey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl(), $publicKey, $secretKey);
    }

    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::g_reload()
     * @throws OmiseException
     */
    public function reload()
    {
        parent::g_reload(self::getUrl());
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
