<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseOccurrence extends OmiseApiResource
{
    const ENDPOINT = 'occurrences';

    /**
     * Retrieves an occurrence object.
     *
     * @param  string $id
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    public static function retrieve($id, $publicKey = null, $secretKey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id), $publicKey, $secretKey);
    }

    /**
     * @throws Exceptions\OmiseException
     */
    public function reload()
    {
        parent::g_reload(self::getUrl($this['id']));
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