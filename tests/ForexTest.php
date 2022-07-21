<?php

use PHPUnit\Framework\TestCase;

class ForexTest extends TestCase
{
    /**
     * @test
     * OmiseForex class must be contain methods as below.
     */
    public function existing_methods()
    {
        $this->assertTrue(method_exists('OmiseSchedule', 'retrieve'));
        $this->assertTrue(method_exists('OmiseSchedule', 'reload'));
        $this->assertTrue(method_exists('OmiseSchedule', 'getUrl'));
    }

    /**
     * @test
     * Forex do not work with staging api key
     */
    public function retrieve()
    {
        $forex = OmiseForex::retrieve('usd');
        $this->assertArrayHasKey('object', $forex);
        $this->assertEquals('forex', $forex['object']);
        $this->assertEquals('usd', $forex['from']);
    }

    /**
     * @test
     * Forex do not work with staging api key
     */
    public function reload()
    {
        $forex = OmiseForex::retrieve('usd');
        $forex->reload();

        $this->assertArrayHasKey('object', $forex);
        $this->assertEquals('forex', $forex['object']);
        $this->assertEquals('usd', $forex['from']);
    }
}
