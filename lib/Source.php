<?php
namespace Omise;

class Source extends \Omise\ApiResource
{
    const OBJECT_NAME = 'source';

    /**
     * Creates a new source.
     *
     * @param  array $params
     *
     * @return Omise\Source
     */
    public static function create($params)
    {
        return parent::resourceCreate($params);
    }
}
