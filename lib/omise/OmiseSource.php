<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';
require_once dirname(__FILE__).'/OmiseRefundList.php';
require_once dirname(__FILE__).'/OmiseScheduleList.php';

class OmiseSource extends OmiseApiResource
{
    const ENDPOINT = 'sources';

    /**
     * Creates a new source.
     *
     * @param  array  $params
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseSource
     */
    public static function create($params, $publickey = null, $secretkey = null)
    {
        return parent::g_create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
    }

    /**
     * @return string
     */
    private static function getUrl()
    {
        return OMISE_API_URL.self::ENDPOINT;
    }
}
