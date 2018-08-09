<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseRefund extends OmiseApiResource
{
    /**
     * @param array $refund
     * @param string $publicKey
     * @param string $secretKey
     */
    public function __construct($refund, $publicKey = null, $secretKey = null)
    {
        parent::__construct($publicKey, $secretKey);
        $this->refresh($refund);
    }

    /**
     * Search for refunds.
     *
     * @param  string $query
     * @param  string $publicKey
     * @param  string $secretKey
     *
     * @return OmiseSearch
     */
    public static function search($query = '', $publicKey = null, $secretKey = null)
    {
        return OmiseSearch::scope('refund', $publicKey, $secretKey)->query($query);
    }
}
