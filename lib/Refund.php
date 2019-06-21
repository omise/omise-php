<?php
namespace Omise;

use Omise\Res\OmiseApiResource;
use Omise\Search;

class Refund extends OmiseApiResource
{
    /**
     * @param array $refund
     */
    public function __construct($refund)
    {
        parent::__construct();
        $this->refresh($refund);
    }

    /**
     * Search for refunds.
     *
     * @param  string $query
     *
     * @return Omise\Search
     */
    public static function search($query = '')
    {
        return Search::scope('refund')->query($query);
    }
}
