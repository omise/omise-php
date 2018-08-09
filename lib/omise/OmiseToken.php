<?php

namespace Omise;

use Omise\Res\OmiseVaultResource;

class OmiseToken extends OmiseVaultResource
{
    const ENDPOINT = 'tokens';

    /**
     * Retrieves a token.
     *
     * @param  string $id
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseToken
     */
    public static function retrieve($id, $publicKey = null, $secretKey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id), $publicKey, $secretKey);
    }

    /**
     * Creates a new token. Please note that this method should be used only
     * in development. In production please use Omise.js!
     *
     * @param  array $params
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseToken
     * @throws Exceptions\OmiseException
     */
    public static function create($params, $publicKey = null, $secretKey = null)
    {
        return parent::g_create(get_class(), self::getUrl(), $params, $publicKey, $secretKey);
    }

    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::g_reload()
     * @throws Exceptions\OmiseException
     */
    public function reload()
    {
        parent::g_reload(self::getUrl($this['id']));
    }

    /**
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return OMISE_VAULT_URL . self::ENDPOINT . '/' . $id;
    }
}
