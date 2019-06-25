<?php
namespace Omise;

class Balance extends \Omise\ApiResource
{
    const OBJECT_NAME = 'balance';

    /**
     * Retrieves a current balance in the given account.
     *
     * @return Omise\Balance
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
