<?php
namespace Omise;

use Omise\Collection;
use Omise\Resource;
use Omise\Search;

class Dispute extends \Omise\ApiResource
{
    const OBJECT_NAME = 'dispute';

    /**
     * Retrieves a collection of Dispute objects.
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
     * Search for disputes.
     *
     * @param  string $query
     *
     * @return Omise\Search
     */
    public static function search($query = '')
    {
        return Search::scope('dispute')->query($query);
    }

    /**
     * Retrieves a dispute.
     *
     * @param  string $id
     *
     * @return Omise\Dispute
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
     * @see Omise\ApiResource::resourceUpdate()
     */
    public function update($params)
    {
        parent::resourceUpdate($params);
    }
}
