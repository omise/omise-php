<?php
namespace Omise;

use Omise\Collection;
use Omise\Refund;
use Omise\Resource;
use Omise\ScheduleList;
use Omise\Scheduler;
use Omise\Search;

class Charge extends \Omise\ApiResource
{
    const OBJECT_NAME = 'charge';

    /**
     * @param  string $query
     *
     * @return Omise\Search
     */
    public static function search($query = '')
    {
        return Search::scope('charge')->query($query);
    }

    /**
     * Retrieves a collection of charge objects.
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
     * Retrieves a charge.
     *
     * @param  string $id
     *
     * @return Omise\Charge
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
     * Schedule a charge.
     *
     * @param  string $params
     *
     * @return Omise\Scheduler
     */
    public static function schedule($params)
    {
        return new Scheduler('charge', $params);
    }

    /**
     * Creates a new charge.
     *
     * @param  array $params
     *
     * @return Omise\Charge
     */
    public static function create($params)
    {
        return parent::resourceCreate($params);
    }

    /**
     * @see Omise\ApiResource::resourceUpdate()
     */
    public function update($params)
    {
        parent::resourceUpdate($params);
    }

    /**
     * Captures a charge.
     *
     * @return Omise\Charge
     */
    public function capture()
    {
        $this->refresh($this->chainRequest('post', 'capture'));
        return $this;
    }

    /**
     * Refund a charge.
     *
     * @return Omise\Refund
     */
    public function refund($params)
    {
        $result = $this->chainRequest('post', 'refunds', $params);

        $this->reload();
        return new Refund($result);
    }

    /**
     * Reverses a charge.
     *
     * @return Omise\Charge
     */
    public function reverse()
    {
        $this->refresh($this->chainRequest('post', 'reverse'));
        return $this;
    }

    /**
     * list refunds
     *
     * @return \Omise\Collection  Of Omise\Refund objects.
     */
    public function refunds($options = array())
    {
        $refunds = is_array($options) && ! empty($options) ? $this->chainRequest('get', 'refunds', $options) : $this['refunds'];
        return new Collection($refunds);
    }

    /**
     * Gets a list of charge schedules.
     *
     * @param  array|string $options
     *
     * @return Omise\ScheduleList
     */
    public static function schedules($options = array())
    {
        if (is_array($options)) {
            $options = '?' . http_build_query($options);
        }

        return parent::g_retrieve('\Omise\ScheduleList', self::getUrl('schedules' . $options));
    }
}
