<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseSearch extends OmiseApiResource
{
    const ENDPOINT = 'search';

    /**
     * Retrieves an resource from search.
     *
     * @param  string $querystring
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseSearch
     */
    public static function retrieve($querystring = '', $publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($querystring), $publickey, $secretkey);
    }

    /**
     * Generate request url.
     *
     * @param  string $querystring
     *
     * @return string
     */
    private static function getUrl($querystring = '')
    {
        return OMISE_API_URL.self::ENDPOINT.'/'.$querystring;
    }
}
