<?php

class OmiseAccount extends OmiseApiResource
{
    const ENDPOINT = 'account';

    /**
     * Retrieves the account information.
     *
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseAccount
     */
    public static function retrieve($publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl(), $publickey, $secretkey);
    }

    /**
     * Updates the account information.
     *
     * @param  array  $params
     */
    public function update($params)
    {
        parent::g_update(self::getUrl(), $params);
    }

    /**
     * Reloads the account information.
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
