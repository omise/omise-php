<?php

class OmiseEvent extends OmiseApiResource
{
    const ENDPOINT = 'events';

    /**
     * Retrieves an event.
     *
     * @param  string $id
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseEvent
     */
    public static function retrieve($id = '', $publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
    }

    /**
     * Generate request url.
     *
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return \Omise\ApiRequestor::OMISE_API_URL.self::ENDPOINT.'/'.$id;
    }
}
