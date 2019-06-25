<?php
namespace Omise;

class Account extends \Omise\ApiResource
{
    const OBJECT_NAME = 'account';

    /**
     * Retrieves Omise account info.
     *
     * @return Omise\Account
     */
    public static function retrieve()
    {
        return parent::resourceRetrieve();
    }

    /**
     * @see Omise\ApiResource::resourceReload()
     */
    public function reload()
    {
        parent::resourceReload();
    }
}
