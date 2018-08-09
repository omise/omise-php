<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseSchedule extends OmiseApiResource
{
    const ENDPOINT = 'schedules';

    /**
     * Retrieves a schedule.
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
     * @return void
     * @throws Exceptions\OmiseException
     */
    public function reload()
    {
        if ($this['object'] === 'schedule') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
    }

    /**
     * Creates a new schedule.
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
     * @param  array|string $options
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    public function occurrences($options = array())
    {
        if ($this['object'] === 'schedule') {
            if (is_array($options)) {
                $options = '?' . http_build_query($options);
            }

            return parent::g_retrieve('OmiseOccurrenceList', self::getUrl($this['id'] . '/occurrences' . $options), $this->_publicKey, $this->_secretKey);
        }

        return null;
    }

    /**
     * @return void
     * @throws Exceptions\OmiseException
     */
    public function destroy()
    {
        parent::g_destroy(self::getUrl($this['id']));
    }

    /**
     * @return bool
     *
     * @see    OmiseApiResource::isDestroyed()
     */
    public function isDestroyed()
    {
        return parent::isDestroyed();
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
