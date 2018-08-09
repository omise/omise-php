<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseTransfer extends OmiseApiResource
{
    const ENDPOINT = 'transfers';

    /**
     * Retrieves a transfer.
     *
     * @param  string $id
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseTransfer
     */
    public static function retrieve($id = '', $publicKey = null, $secretKey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id), $publicKey, $secretKey);
    }

    /**
     * Search for transfers.
     *
     * @param  string $query
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseSearch
     */
    public static function search($query = '', $publicKey = '', $secretKey = '')
    {
        return OmiseSearch::scope('transfer', $publicKey, $secretKey)->query($query);
    }

    /**
     * Schedule a transfer.
     *
     * @param  string $params
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseScheduler
     */
    public static function schedule($params, $publicKey = null, $secretKey = null)
    {
        return new OmiseScheduler('transfer', $params, $publicKey, $secretKey);
    }

    /**
     * Creates a transfer.
     *
     * @param  mixed $params
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseTransfer
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
        if ($this['object'] === 'transfers') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
    }

    /**
     * Updates the transfer amount.
     * @throws Exceptions\OmiseException
     */
    public function save()
    {
        $this->update(array('amount' => $this['amount']));
    }

    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::g_update()
     * @param $params
     * @throws Exceptions\OmiseException
     */
    protected function update($params)
    {
        parent::g_update(self::getUrl($this['id']), $params);
    }

    /**
     * Gets a list of transfer schedules.
     *
     * @param  array|string $options
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    public static function schedules($options = array(), $publicKey = null, $secretKey = null)
    {
        if (is_array($options)) {
            $options = '?' . http_build_query($options);
        }

        return parent::g_retrieve('OmiseScheduleList', self::getUrl('schedules' . $options), $publicKey, $secretKey);
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
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }
}
