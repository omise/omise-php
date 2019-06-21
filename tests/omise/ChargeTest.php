<?php require_once dirname(__FILE__).'/TestConfig.php';

class ChargeTest extends TestConfig
{
    /**
     * @test
     * Assert that a list of charge object could be successfully retrieved.
     */
    public function retrieve_charge_collection()
    {
        $charge = OmiseCharge::all();

        $this->assertEquals('charge', $charge['collection']);
    }

    /**
     * @test
     * Assert that a charge is successfully created with the given parameters set.
     */
    public function create()
    {
        $params = array(
            'amount'      => 100000,
            'currency'    => 'thb',
            'description' => 'Order-384',
            'ip'          => '127.0.0.1',
            'card'        => 'tokn_test_fixture'
        );

        $charge = OmiseCharge::create($params);

        $this->assertArrayHasKey('object', $charge);
        $this->assertEquals('charge', $charge['object']);
    }

    /**
     * @test
     * Assert that a charge object is returned after a successful retrieve.
     */
    public function retrieve_specific_charge_object()
    {
        $charge = OmiseCharge::retrieve('chrg_test_fixture');

        $this->assertArrayHasKey('object', $charge);
        $this->assertEquals('charge', $charge['object']);
    }

    /**
     * @test
     * Assert that a charge is successfully updated with the given parameters set.
     */
    public function update()
    {
        $charge = OmiseCharge::retrieve('chrg_test_fixture');
        $charge->update(array('description' => 'mock'));

        $this->assertArrayHasKey('object', $charge);
        $this->assertEquals('charge', $charge['object']);
        $this->assertEquals('mock', $charge['description']);
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
        $charge = OmiseCharge::retrieve('chrg_test_fixture');
        $charge->capture();

        $this->assertArrayHasKey('object', $charge);
        $this->assertEquals('charge', $charge['object']);
        $this->assertTrue($charge['paid']);
    }

    /**
     * @test
     */
    public function refund()
    {
        $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');
        $refund = $charge->refund(array('amount' => 10000));

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
        $charge = OmiseCharge::retrieve('chrg_test_53z5zoeovi39e1erbj0');
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
                                ->filter(array('captured' => true))
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
     */
    public function retrieve_schedules()
    {
        $schedules = OmiseCharge::schedules();

        $this->assertArrayHasKey('object', $schedules);
        $this->assertEquals('list', $schedules['object']);
        $this->assertEquals('schedule', $schedules['data'][0]['object']);
        $this->assertArrayHasKey('charge', $schedules['data'][0]);
    }

    /**
     * @test
     */
    public function create_scheduler()
    {
        $charge = array(
            'customer' => 'cust_test_58e7azwu6owk31ok81y',
            'amount'   => 99900
        );

        $scheduler = OmiseCharge::schedule($charge);

        $this->assertEquals($charge, $scheduler['charge']);
    }
}
