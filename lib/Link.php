<?php
namespace Omise;

use Omise\Res\OmiseApiResource;
use Omise\Search;

class Link extends OmiseApiResource
{
    const ENDPOINT = 'links';

    /**
     * Retrieves a link.
     *
     * @param  string $id
     *
     * @return Omise\Link
     */
    public static function retrieve($id = '')
    {
        return parent::g_retrieve(get_class(), self::getUrl($id));
    }

    /**
     * Search for links.
     *
     * @param  string $query
     *
     * @return Omise\Search
     */
    public static function search($query = '')
    {
        return Search::scope('link')->query($query);
    }

    /**
     * @see Omise\Res\OmiseApiResource::g_reload()
     */
    public function reload()
    {
        if ($this['object'] === 'link') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
    }

    /**
     * Creates a new link.
     *
     * @param  array $params
     *
     * @return Omise\Link
     */
    public static function create($params)
    {
        return parent::g_create(get_class(), self::getUrl(), $params);
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
