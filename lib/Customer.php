<?php
namespace Omise;

use Omise\Res\OmiseApiResource;
use Omise\CardList;
use Omise\ScheduleList;
use Omise\Search;

class Customer extends OmiseApiResource
{
    const ENDPOINT = 'customers';

    /**
     * Retrieves a customer.
     *
     * @param  string $id
     *
     * @return Omise\Customer
     */
    public static function retrieve($id = '')
    {
        return parent::g_retrieve(get_class(), self::getUrl($id));
    }

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
     * Creates a new customer.
     *
     * @param  array  $params
     *
     * @return Omise\Customer
     */
    public static function create($params)
    {
        return parent::g_create(get_class(), self::getUrl(), $params);
    }

    /**
     * @see Omise\Res\OmiseApiResource::g_reload()
     */
    public function reload()
    {
        if ($this['object'] === 'customer') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
    }

    /**
     * @see Omise\Res\OmiseApiResource::g_update()
     */
    public function update($params)
    {
        parent::g_update(self::getUrl($this['id']), $params);
    }

    /**
     * @see Omise\Res\OmiseApiResource::g_destroy()
     */
    public function destroy()
    {
        parent::g_destroy(self::getUrl($this['id']));
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
     * @return Omise\CardList
     */
    public function cards($options = array())
    {
        if (is_array($options) && ! empty($options)) {
            $cards = $this->apiRequestor->get(self::getUrl($this['id']) . '/cards?' . http_build_query($options), parent::getResourceKey());
        } else {
            $cards = $this['cards'];
        }

        return new CardList($cards, $this['id']);
    }
  
    /**
     * cards() alias
     *
     * @deprecated deprecated since version 2.0.0 use '$customer->cards()'
     *
     * @return     Omise\CardList
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
        if ($this['object'] === 'customer') {
            if (is_array($options)) {
                $options = '?' . http_build_query($options);
            }

            return parent::g_retrieve('\Omise\ScheduleList', self::getUrl($this['id'] . '/schedules' . $options));
        }
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
