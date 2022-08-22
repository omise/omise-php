<?php

class OmiseBalance extends OmiseApiResource
{
    const ENDPOINT = 'balance';

    /**
     * Retrieves a current balance in the account.
     *
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseBalance
     */
    public static function retrieve($publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(self::getUrl(), $publickey, $secretkey);
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_reload()
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
