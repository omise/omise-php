<?php

class OmiseBalance extends OmiseApiResource
{
    const ENDPOINT = 'balance';

    /**
     * Retrieves the current balance on the account.
     *
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseBalance
     */
    public static function retrieve($publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl(), $publickey, $secretkey);
    }

    /**
     * Reloads the current balance on the account.
     */
    public function reload()
    {
        parent::g_reload(self::getUrl());
    }

    /**
     * Generates a request URL.
     *
     * @return string
     */
    private static function getUrl()
    {
        return OMISE_API_URL . self::ENDPOINT;
    }
}
