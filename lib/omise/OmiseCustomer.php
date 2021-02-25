<?php

class OmiseCustomer extends OmiseApiResource
{
    const ENDPOINT = 'customers';

    /**
     * Retrieves a customer.
     *
     * @param  string $id
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseCustomer
     */
    public static function retrieve($id = '', $publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
    }

    /**
     * Searches for customers.
     *
     * @param  string $query
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseSearch
     */
    public static function search($query = '', $publickey = null, $secretkey = null)
    {
        return OmiseSearch::scope('customer', $publickey, $secretkey)->query($query);
    }

    /**
     * Creates a new customer.
     *
     * @param  array  $params
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseCustomer
     */
    public static function create($params, $publickey = null, $secretkey = null)
    {
        return parent::g_create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
    }

    /**
     * Reloads the customer.
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
     * Updates the customer.
     *
     * @param  array  $params
     */
    public function update($params)
    {
        parent::g_update(self::getUrl($this['id']), $params);
    }

    /**
     * Destroys the customer.
     */
    public function destroy()
    {
        parent::g_destroy($this->getUrl($this['id']));
    }

    /**
     * Checks whether the customer has been destroyed.
     *
     * @return bool
     */
    public function isDestroyed()
    {
        return parent::isDestroyed();
    }

    /**
     * Lists cards of the customer.
     *
     * @param  array|string $options
     *
     * @return OmiseCardList
     */
    public function cards($options = array())
    {
        if (is_array($options) && ! empty($options)) {
            $cards = parent::execute(self::getUrl($this['id']) . '/cards?' . http_build_query($options), parent::REQUEST_GET, parent::getResourceKey());
        } else {
            $cards = $this['cards'];
        }

        return new OmiseCardList($cards, $this['id'], $this->_publickey, $this->_secretkey);
    }
  
    /**
     * cards() alias
     *
     * @deprecated deprecated since version 2.0.0 use '$customer->cards()'
     *
     * @return     OmiseCardList
     */
    public function getCards($options = array())
    {
        return $this->cards($options);
    }

    /**
     * Lists charge schedules of the customer.
     *
     * @param  array|string $options
     *
     * @return OmiseScheduleList
     */
    public function schedules($options = array())
    {
        return parent::g_list('OmiseScheduleList', self::getUrl($this['id'] . '/schedules'), $options, $this->_publickey, $this->_secretkey);
    }

    /**
     * Generates a request URL.
     *
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }
}
