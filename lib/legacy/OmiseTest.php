<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
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
