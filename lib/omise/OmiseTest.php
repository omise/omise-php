<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseTest extends OmiseApiResource
{
    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::getInstance()
     * @throws \Exception
     */
    public static function resource()
    {
        return parent::getInstance(get_class());
    }
}
