<?php
require_once dirname(__FILE__).'/TestConfig.php';

class RefundTest extends TestConfig
{
    /**
     * @test
     * Assert that a list of refunds object could be successfully retrieved.
     */
    public function retrieve_charge_refund_list_object()
    {
        $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');
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
        $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');
        $refunds = $charge->refunds();

        $refund = $refunds->create(array('amount' => 10000));

        $this->assertArrayHasKey('object', $refund);
        $this->assertEquals('refund', $refund['object']);
    }

    /**
     * @test
     */
    public function retrieve_specific_charge_refund_object()
    {
        $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');
        $refunds = $charge->refunds();

        $create = $refunds->create(array('amount' => 10000));
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
                                ->filter(array('voided' => true));

        $this->assertArrayHasKey('object', $result);
        $this->assertEquals('search', $result['object']);

        foreach ($result['data'] as $item) {
            $this->assertArrayHasKey('object', $item);
            $this->assertEquals('refund', $item['object']);
        }
    }
}
