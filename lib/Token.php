<?php
namespace Omise;

use Omise\Res\OmiseVaultResource;

class Token extends OmiseVaultResource
{
    const ENDPOINT = 'tokens';

    /**
     * Retrieves a token.
     *
     * @param  string $id
     *
     * @return OmiseToken
     */
    public static function retrieve($id)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id));
    }

    /**
     * Creates a new token. Please note that this method should be used only
     * in development. In production please use Omise.js!
     *
     * @param  array $params
     *
     * @return OmiseToken
     */
    public static function create($params)
    {
        return parent::g_create(get_class(), self::getUrl(), $params);
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_reload()
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
        return \Omise\ApiRequestor::OMISE_VAULT_URL . self::ENDPOINT . '/' . $id;
    }
}
