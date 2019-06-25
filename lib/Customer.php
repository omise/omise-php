<?php
namespace Omise;

use Omise\Collection;
use Omise\Resource;
use Omise\Search;

class Customer extends \Omise\ApiResource
{
    const OBJECT_NAME = 'customer';

    /**
     * Search for customers.
     *
     * @param  string $query
     *
     * @return Omise\Search
     */
    public static function search($query = '')
    {
        return Search::scope('customer')->query($query);
    }

    /**
     * Retrieves customer objects.
     *
     * @param  string $id
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
     * Retrieves a customer.
     *
     * @param  string $id
     *
     * @return Omise\Customer
     */
    public static function retrieve($id)
    {
        return parent::resourceRetrieve($id);
    }

    /**
     * Creates a new customer.
     *
     * @param  array  $params
     *
     * @return Omise\Customer
     */
    public static function create($params)
    {
        return parent::resourceCreate($params);
    }

    /**
     * @see Omise\ApiResource::g_reload()
     */
    public function reload()
    {
        parent::resourceReload();
    }

    /**
     * @see Omise\Res\OmiseApiResource::g_update()
     */
    public function update($params)
    {
        parent::resourceUpdate($params);
    }

    /**
     * @see Omise\xApiResource::g_destroy()
     */
    public function destroy()
    {
        parent::resourceDestroy();
    }

    /**
     * @see Omise\Res\OmiseApiResource::isDestroyed()
     */
    public function isDestroyed()
    {
        return parent::isDestroyed();
    }

    /**
     * Gets a list of all cards belongs to this customer.
     *
     * @param  array $options
     *
     * @return Omise\Collection
     */
    public function cards($options = array())
    {
        $cards = is_array($options) && ! empty($options) ? $this->chainRequest('get', 'cards', $options) : $this['cards'];
        return new Collection($cards);
    }
  
    /**
     * cards() alias
     *
     * @deprecated deprecated since version 2.0.0 use '$customer->cards()'
     *
     * @return     Omise\Collection
     */
    public function getCards($options = array())
    {
        return $this->cards($options);
    }

    /**
     * Gets a list of charge schedules that belongs to a given customer.
     *
     * @param  array|string $options
     *
     * @return Omise\ScheduleList
     */
    public function schedules($options = array())
    {
        $schedules = $this->chainRequest('get', 'schedules', $options);
        return new Collection($schedules);
    }
}
