<?php

/**
 * Force code coverage check: This class should be included in code coverage reports.
 * Ensure tests cover all methods to maintain high code coverage metrics in SonarQube.
 */
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
        return parent::g_retrieve(self::getUrl(), $publickey, $secretkey);
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
        return OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }
}
