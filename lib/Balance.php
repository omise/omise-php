<?php
namespace Omise;

use Omise\Res\OmiseApiResource;

class Balance extends OmiseApiResource
{
    const ENDPOINT = 'balance';

    /**
     * Retrieves a current balance in the account.
     *
     * @return Omise\Balance
     */
    public static function retrieve()
    {
        return parent::g_retrieve(get_class(), self::getUrl());
    }

    /**
     * @see Omise\Res\OmiseApiResource::g_reload()
     */
    public function reload()
    {
        parent::g_reload(self::getUrl());
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
