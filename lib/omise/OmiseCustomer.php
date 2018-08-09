<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseCustomer extends OmiseApiResource
{
    const ENDPOINT = 'customers';

    /**
     * Retrieves a customer.
     *
     * @param  string $id
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseCustomer
     */
    public static function retrieve($id = '', $publicKey = null, $secretKey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id), $publicKey, $secretKey);
    }

    /**
     * Search for customers.
     *
     * @param  string $query
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseSearch
     */
    public static function search($query = '', $publicKey = null, $secretKey = null)
    {
        return OmiseSearch::scope('customer', $publicKey, $secretKey)->query($query);
    }

    /**
     * Creates a new customer.
     *
     * @param  array $params
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseCustomer
     * @throws Exceptions\OmiseException
     */
    public static function create($params, $publicKey = null, $secretKey = null)
    {
        return parent::g_create(get_class(), self::getUrl(), $params, $publicKey, $secretKey);
    }

    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::g_reload()
     * @throws Exceptions\OmiseException
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
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::g_update()
     * @param $params
     * @throws Exceptions\OmiseException
     */
    public function update($params)
    {
        parent::g_update(self::getUrl($this['id']), $params);
    }

    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::g_destroy()
     * @throws Exceptions\OmiseException
     */
    public function destroy()
    {
        parent::g_destroy(self::getUrl($this['id']));
    }

    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::isDestroyed()
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
     * @return OmiseCardList
     * @throws Exceptions\OmiseException
     */
    public function cards($options = array())
    {
        if ($this['object'] === 'customer') {
            return new OmiseCardList($this['cards'], $this['id'], $options, $this->_publicKey, $this->_secretKey);
        }

        return null;
    }

    /**
     * cards() alias
     *
     * @deprecated deprecated since version 2.0.0 use '$customer->cards()'
     *
     * @param array $options
     * @return     OmiseCardList
     * @throws Exceptions\OmiseException
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
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    public function schedules($options = array())
    {
        if ($this['object'] === 'customer') {
            if (is_array($options)) {
                $options = '?' . http_build_query($options);
            }

            return parent::g_retrieve('OmiseScheduleList', self::getUrl($this['id'] . '/schedules' . $options), $this->_publicKey, $this->_secretKey);
        }

        return null;
    }

    /**
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }
}
