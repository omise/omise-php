<?php
namespace Omise;

use Omise\Collection;
use Omise\Resource;

class Event extends \Omise\ApiResource
{
    const OBJECT_NAME = 'event';

    /**
     * Retrieves a collection of event objects.
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
     * Retrieves an event.
     *
     * @param  string $id
     *
     * @return Omise\Event
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
}
