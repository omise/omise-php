<?php
namespace Omise;

class Forex extends \Omise\ApiResource
{
    const OBJECT_NAME = 'forex';

    /**
     * Retrieves a forex data.
     *
     * @param  string $currency
     *
     * @return Omise\Forex
     */
    public static function retrieve($currency)
    {
        return parent::resourceRetrieve($currency);
    }

    /**
     * @see Omise\ApiResource::resourceReload()
     */
    public function reload()
    {
        parent::resourceReload();
    }
}
