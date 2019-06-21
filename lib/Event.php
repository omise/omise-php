<?php
namespace Omise;

use Omise\Res\OmiseApiResource;

class Event extends OmiseApiResource
{
    const ENDPOINT = 'events';

    /**
     * Retrieves an event.
     *
     * @param  string $id
     *
     * @return Omise\Event
     */
    public static function retrieve($id = '')
    {
        return parent::g_retrieve(get_class(), self::getUrl($id));
    }

    /**
     * @see Omise\Res\OmiseApiResource::g_reload()
     */
    public function reload()
    {
        if ($this['object'] === 'event') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
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
        return \Omise\ApiRequestor::OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }
}
