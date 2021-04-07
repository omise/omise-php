<?php

class OmiseChain extends OmiseApiResource
{
    const ENDPOINT = 'chains';

    /**
     * Retrieves a sub-merchant chain.
     *
     * @param  string $id
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseChain
     */
    public static function retrieve($id = '', $publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
    }

    /**
     * Reloads a sub-merchant chain.
     */
    public function reload()
    {
        if ($this['object'] === 'chain') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
    }

    /**
     * Revokes a sub-merchant chain.
     */
    public function revoke()
    {
        parent::g_process(self::getUrl($this['id']) . '/revoke');
    }

    /**
     * Generates a request URL.
     *
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }
}
