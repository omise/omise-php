<?php
require_once dirname(__FILE__).'/TestConfig.php';

class OmiseBalanceTest extends TestConfig
{
    /**
     * @test
     * OmiseBalance class must be contain some method below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseBalance', 'retrieve'));
        $this->assertTrue(method_exists('OmiseBalance', 'reload'));
        $this->assertTrue(method_exists('OmiseBalance', 'getUrl'));
    }

    /**
     * @test
     * Assert that a balance object is returned after a successful retrieve.
     */
    public function retrieve_omise_balance_object()
    {
        $balance = OmiseBalance::retrieve();

        $this->assertArrayHasKey('object', $balance);
        $this->assertEquals('balance', $balance['object']);
    }

    /**
     * @test
     * Assert that a balance object is returned after a successful reload.
     */
    public function reload()
    {
        $balance = OmiseBalance::retrieve();
        $balance->reload();

        $this->assertArrayHasKey('object', $balance);
        $this->assertEquals('balance', $balance['object']);
    }
}
