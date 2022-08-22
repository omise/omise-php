<?php

use PHPUnit\Framework\TestCase;
use Omise\Traits\ChargeTrait;

class RefundTest extends TestCase
{
    use ChargeTrait;
    /**
     * @test
     * Assert that a list of refunds object could be successfully retrieved.
     */
    public function retrieve_charge_refund_list_object()
    {
        $charge = $this->createCharge(true);
        $refunds = $charge->refunds();
        $this->assertArrayHasKey('object', $refunds);
        $this->assertEquals('list', $refunds['object']);
    }

    /**
     * @test
     * Assert that a refund is successfully created with the given parameters set.
     */
    public function create()
    {
        $charge = $this->createCharge(true);
        $refunds = $charge->refunds();
        $refund = $refunds->create(['amount' => 10000]);
        $this->assertArrayHasKey('object', $refund);
        $this->assertEquals('refund', $refund['object']);
    }

    /**
     * @test
     * Assert that a refund can be retrieve after created successfully.
     */
    public function retrieve_specific_charge_refund_object()
    {
        $charge = $this->createCharge(true);
        $refunds = $charge->refunds();
        $create = $refunds->create(['amount' => 10000]);
        $refund = $refunds->retrieve($create['id']);
        $this->assertArrayHasKey('object', $refund);
        $this->assertEquals('refund', $refund['object']);
    }

    /**
     * @test
     * Assert that OmiseRefund can search for refunds.
     */
    public function search()
    {
        $result = OmiseRefund::search()
            ->filter(['voided' => true]);
        $this->assertArrayHasKey('object', $result);
        $this->assertEquals('search', $result['object']);
        foreach ($result['data'] as $item) {
            $this->assertArrayHasKey('object', $item);
            $this->assertEquals('refund', $item['object']);
        }
    }
}
