<?php

class OmiseAccount extends OmiseApiResource
{
    const ENDPOINT = 'account';

    /**
     * Retrieves an account.
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
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_update()
     */
    public function update($params)
    {
        parent::g_update(self::getUrl(), $params);
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
        return OMISE_API_URL.self::ENDPOINT.'/'.$id;
    }
}
