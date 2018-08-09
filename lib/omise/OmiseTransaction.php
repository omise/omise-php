<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseTransaction extends OmiseApiResource
{
    const ENDPOINT = 'transactions';

    /**
     * Retrieves a transaction.
     *
     * @param  string $id
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseTransaction
     */
    public static function retrieve($id = '', $publicKey = null, $secretKey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id), $publicKey, $secretKey);
    }

    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::g_reload()
     * @throws Exceptions\OmiseException
     */
    public function reload()
    {
        if ($this['object'] === 'transaction') {
            parent::reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
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
