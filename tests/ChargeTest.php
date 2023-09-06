<?php

use PHPUnit\Framework\TestCase;
use Omise\Traits\ChargeTrait;

class ChargeTest extends TestCase
{
    /**
     * use charge trait to create a charge using
     * default customer id and card id.
     */
    use ChargeTrait;

    /**
     * @test
     * OmiseCharge class must be contain some method below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseCharge', 'reload'));
        $this->assertTrue(method_exists('OmiseCharge', 'create'));
        $this->assertTrue(method_exists('OmiseCharge', 'update'));
        $this->assertTrue(method_exists('OmiseCharge', 'capture'));
        $this->assertTrue(method_exists('OmiseCharge', 'reverse'));
        $this->assertTrue(method_exists('OmiseCharge', 'expire'));
        $this->assertTrue(method_exists('OmiseCharge', 'refund'));
        $this->assertTrue(method_exists('OmiseCharge', 'refunds'));
        $this->assertTrue(method_exists('OmiseCharge', 'getUrl'));
    }

    /**
     * @test
     * Assert that a list of charge object could be successfully retrieved.
     */
    public function retrieve_charge_list_object()
    {
        $charge = OmiseCharge::retrieve();

        $this->assertArrayHasKey('object', $charge);
        $this->assertEquals('list', $charge['object']);
    }

    /**
     * @test
     * Assert that a charge is successfully created with the given parameters set.
     */
    public function create()
    {
        $charge = $this->createCharge();

        $this->assertArrayHasKey('object', $charge);
        $this->assertEquals('charge', $charge['object']);
    }

    /**
     * @test
     * Assert that a charge object is returned after a successful retrieve.
     */
    public function retrieve_specific_charge_object()
    {
        $charge = $this->createCharge();
        $charge = OmiseCharge::retrieve($charge['id']);
        $this->assertArrayHasKey('object', $charge);
        $this->assertEquals('charge', $charge['object']);
    }

    /**
     * @test
     * Assert that a charge is successfully updated with the given parameters set.
     */
    public function update()
    {
        $charge = $this->createCharge();
        $charge->update(['description' => 'Another description']);

        $this->assertArrayHasKey('object', $charge);
        $this->assertEquals('charge', $charge['object']);
    }

    /**
     * @test
     * Assert that a captured flag is set after charge is successfully captured.
     *
     * In our test environment, the charge will be auto-captured after create
     * and this test will raise OmiseFailedCaptureException.
     */
    public function capture()
    {
        $charge = $this->createCharge(false);
        $charge->capture();
        $this->assertArrayHasKey('object', $charge);
        $this->assertEquals('charge', $charge['object']);
        $this->assertNull($charge['failure_code']);
    }

    /**
     * @test
     * Assert that a pre authorized charge is partially captured based on set capture amount.
     */
    public function partialCapture()
    {
        $charge = $this->createChargePreAuth();
        $charge->capture(['capture_amount' => $charge['amount'] / 2]);
        $this->assertArrayHasKey('object', $charge);
        $this->assertEquals('charge', $charge['object']);
        $this->assertNull($charge['failure_code']);
        $this->assertEquals($charge['authorization_type'], 'pre_auth');
        $this->assertEquals($charge['amount'] / 2, $charge['captured_amount']);
    }

    /**
    * @test
    * Assert that a refund flag is set after charge is successfully refund.
    */
    public function refund()
    {
        $charge = $this->createCharge(true);
        $refund = $charge->refund(['amount' => 10000]);

        $this->assertArrayHasKey('object', $refund);
        $this->assertEquals('refund', $refund['object']);
        $this->assertEquals(10000, $refund['amount']);
    }

    /**
     * @test
     * Assert that a reversed flag is set after charge is successfully reversed.
     */
    public function reverse()
    {
        $charge = $this->createCharge();
        $charge->reverse();
        $this->assertArrayHasKey('object', $charge);
        $this->assertEquals('charge', $charge['object']);
        $this->assertTrue($charge['reversed']);
    }

    /**
     * @test
     * Assert that OmiseCharge can search for charges.
     */
    public function search()
    {
        $result = OmiseCharge::search('order')
            ->filter(['captured' => true])
            ->page(2)
            ->order('reverse_chronological');
        $this->assertTrue($result->isDirty());
        $this->assertArrayHasKey('object', $result);
        $this->assertEquals('search', $result['object']);
        $this->assertFalse($result->isDirty());

        foreach ($result['data'] as $item) {
            $this->assertArrayHasKey('object', $item);
            $this->assertEquals('charge', $item['object']);
        }

        $result = $result->page(1);
        $this->assertTrue($result->isDirty());

        $result->reload();
        $this->assertFalse($result->isDirty());

        $this->assertArrayHasKey('object', $result);
        $this->assertEquals('search', $result['object']);

        foreach ($result['data'] as $item) {
            $this->assertArrayHasKey('object', $item);
            $this->assertEquals('charge', $item['object']);
        }
    }

    /**
     * @test
     * Assert that OmiseCharge can create schedule using customer id.
     */
    public function create_scheduler()
    {
        $charge = [
            'customer' => OMISE_CUSTOMER_ID,
            'amount' => 99900
        ];
        $scheduler = OmiseCharge::schedule($charge);
        $this->assertEquals($charge, $scheduler['charge']);
    }

    /**
    * @test
    * Assert that an expired flag is set after charge is successfully set to expire.
    */
    public function expire()
    {
        $charge = $this->createChargeWithSource();
        $charge->expire();
        $this->assertArrayHasKey('object', $charge);
        $this->assertEquals('charge', $charge['object']);
        $this->assertTrue($charge['expired']);
    }

    /**
     * @test
     * Assert that OmiseCharge can retrieve schedules.
     */
    public function retrieve_schedules()
    {
        $schedules = OmiseCharge::schedules();
        $this->assertArrayHasKey('object', $schedules);
        $this->assertEquals('list', $schedules['object']);
        if (isset($schedules['data'][0])) {
            $this->assertEquals('schedule', $schedules['data'][0]['object']);
            $this->assertArrayHasKey('charge', $schedules['data'][0]);
        }
    }
}
