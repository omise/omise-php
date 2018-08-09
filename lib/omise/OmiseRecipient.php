<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseRecipient extends OmiseApiResource
{
    const ENDPOINT = 'recipients';

    /**
     * Retrieves recipients.
     *
     * @param  string $id
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    public static function retrieve($id = '', $publicKey = null, $secretKey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id), $publicKey, $secretKey);
    }

    /**
     * Search for recipients.
     *
     * @param  string $query
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseSearch
     */
    public static function search($query = '', $publicKey = null, $secretKey = null)
    {
        return OmiseSearch::scope('recipient', $publicKey, $secretKey)->query($query);
    }

    /**
     * Creates a new recipient.
     *
     * @param  array $params
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     * @throws Exceptions\OmiseException
     */
    public static function create($params, $publicKey = null, $secretKey = null)
    {
        return parent::g_create(get_class(), self::getUrl(), $params, $publicKey, $secretKey);
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
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::g_reload()
     * @throws Exceptions\OmiseException
     */
    public function reload()
    {
        if ($this['object'] === 'recipient') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
    }

    /**
     * Gets a list of transfer schedules that belongs to a given recipient.
     *
     * @param  array|string $options
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    public function schedules($options = array())
    {
        if ($this['object'] === 'recipient') {
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
