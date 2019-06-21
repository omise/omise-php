<?php
namespace Omise;

use Omise\Res\OmiseApiResource;
use Omise\Refund;
use Omise\RefundList;
use Omise\ScheduleList;
use Omise\Scheduler;
use Omise\Search;

class Charge extends OmiseApiResource
{
    const ENDPOINT = 'charges';

    /**
     * Retrieves a charge.
     *
     * @param  string $id
     *
     * @return Omise\Charge
     */
    public static function retrieve($id = '')
    {
        return parent::g_retrieve(get_class(), self::getUrl($id));
    }

    /**
     * Search for charges.
     *
     * @param  string $query
     *
     * @return Omise\Search
     */
    public static function search($query = '')
    {
        return Search::scope('charge')->query($query);
    }

    /**
     * @see Omise\Res\OmiseApiResource::g_reload()
     */
    public function reload()
    {
        if ($this['object'] === 'charge') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
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
        return parent::g_create(get_class(), self::getUrl(), $params);
    }

    /**
     * @see Omise\Res\OmiseApiResource::g_update()
     */
    public function update($params)
    {
        parent::g_update(self::getUrl($this['id']), $params);
    }

    /**
     * Captures a charge.
     *
     * @return Omise\Charge
     */
    public function capture()
    {
        $result = $this->apiRequestor->post(self::getUrl($this['id']).'/capture', parent::getResourceKey());
        $this->refresh($result);

        return $this;
    }

    /**
     * Refund a charge.
     *
     * @return Omise\Refund
     */
    public function refund($params)
    {
        $result = $this->apiRequestor->post(self::getUrl($this['id']) . '/refunds', parent::getResourceKey(), $params);
        return new Refund($result);
    }

    /**
     * Reverses a charge.
     *
     * @return Omise\Charge
     */
    public function reverse()
    {
        $result = $this->apiRequestor->post(self::getUrl($this['id']).'/reverse', parent::getResourceKey());
        $this->refresh($result);

        return $this;
    }

    /**
     * list refunds
     *
     * @return Omise\RefundList
     */
    public function refunds($options = array())
    {
        if (is_array($options) && ! empty($options)) {
            $refunds = $this->apiRequestor->get(self::getUrl($this['id']) . '/refunds?' . http_build_query($options), parent::getResourceKey());
        } else {
            $refunds = $this['refunds'];
        }

        return new RefundList($refunds, $this['id']);
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
