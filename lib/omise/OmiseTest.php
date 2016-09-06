<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';

class OmiseTest extends OmiseApiResource
{
    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::getInstance()
     */
    public static function resource()
    {
        return parent::getInstance(get_class());
    }
}
