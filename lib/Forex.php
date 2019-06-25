<?php
namespace Omise;

use Omise\Res\OmiseApiResource;

class Forex extends OmiseApiResource
{
    const ENDPOINT = 'forex';

    /**
     * Retrieves a forex data.
     *
     * @param  string $currency
     *
     * @return OmiseForex
     */
    public static function retrieve($currency = '')
    {
        return parent::g_retrieve(get_class(), self::getUrl($currency));
    }

    /**
     * @see OmiseApiResource::g_reload()
     */
    public function reload()
    {
        parent::g_reload(self::getUrl($this['from']));
    }

    /**
     * @param  string $currency
     *
     * @return string
     */
    private static function getUrl($currency = '')
    {
        return \Omise\ApiRequestor::OMISE_API_URL . self::ENDPOINT . '/' . $currency;
    }
}
