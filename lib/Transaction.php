<?php
namespace Omise;

use Omise\Collection;
use Omise\Resource;

class Transaction extends \Omise\ApiResource
{
    const OBJECT_NAME = 'transaction';

    /**
     * Retrieves a collection of transaction objects.
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
     * Retrieves a link object.
     *
     * @param  string $id
     *
     * @return Omise\Transaction
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
