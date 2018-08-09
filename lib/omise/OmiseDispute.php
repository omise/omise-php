<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseDispute extends OmiseApiResource
{
    const ENDPOINT = 'disputes';

    /**
     * Retrieves a dispute.
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
     * Search for disputes.
     *
     * @param  string $query
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseSearch
     */
    public static function search($query = '', $publicKey = null, $secretKey = null)
    {
        return OmiseSearch::scope('dispute', $publicKey, $secretKey)->query($query);
    }

    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::g_reload()
     * @throws Exceptions\OmiseException
     */
    public function reload()
    {
        if ($this['object'] === 'dispute') {
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
     * Generate request url.
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
