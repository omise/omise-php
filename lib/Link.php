<?php
namespace Omise;

use Omise\Collection;
use Omise\Resource;
use Omise\Search;

class Link extends \Omise\ApiResource
{
    const OBJECT_NAME = 'link';

    /**
     * Retrieves a collection of link objects.
     *
     * @param  array $query
     *
     * @return Omise\Collection
     */
    public static function all($query = array())
    {
        $resource = Resource::newObject(static::OBJECT_NAME);
        $result   = $resource->request()->get($resource->url(), $resource->credential(), $query);

        return new Collection($result);
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
     * Retrieves a link object.
     *
     * @param  string $id
     *
     * @return Omise\Link
     */
    public static function retrieve($id)
    {
        return parent::resourceRetrieve($id);
    }

    /**
     * @see Omise\ApiResource::resourceReload()
     */
    public function reload()
    {
        parent::resourceReload();
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
        return parent::resourceCreate($params);
    }
}
