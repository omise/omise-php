<?php

namespace Traits;

use OmiseCharge;
use OmiseSource;

/**
 * ChargeTrait to reuse in
 * - ChargeTest
 * - Dispute Test
 * - Refund Test
 */
trait ChargeTrait
{
    public function createCharge($capture = false)
    {
        return OmiseCharge::create([
            'amount' => 100000,
            'currency' => 'thb',
            'description' => 'Order-123',
            'ip' => '127.0.0.1',
            'customer' => OMISE_CUSTOMER_ID,
            'card' => OMISE_CARD_ID,
            'capture' => $capture,
        ]);
    }

    public function createChargeWithSource()
    {
        $source = OmiseSource::create([
            'amount' => 100000,
            'currency' => 'thb',
            'type' => 'barcode_alipay',
            'barcode' => rand(100000000, 99999999),
        ]);
        return OmiseCharge::create([
            'amount' => 100000,
            'currency' => 'thb',
            'description' => 'Order-expire',
            'ip' => '127.0.0.1',
            'source' => $source['id'],
            'return_uri' => 'https://omise.co'
        ]);
    }
}
