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
        return parent::g_retrieve(get_class(), null, $publickey, $secretkey);
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
}
