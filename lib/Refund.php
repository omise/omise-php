<?php
namespace Omise;

use Omise\Search;

class Refund extends \Omise\ApiResource
{
    const OBJECT_NAME = 'refund';

    /**
     * @param  string $query
     *
     * @return Omise\Search
     */
    public static function search($query = '')
    {
        return Search::scope('refund')->query($query);
    }
}
