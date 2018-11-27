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
        return parent::g_retrieve(get_class(), self::getUrl(), $publickey, $secretkey);
    }

    /**
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return \Omise\ApiRequestor::OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }
}
