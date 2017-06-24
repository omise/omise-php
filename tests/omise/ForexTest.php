<?php
require_once dirname(__FILE__) . '/TestConfig.php';

class ForexTest extends TestConfig
{
    /**
     * @test
     */
    public function existing_methods()
    {
        $this->assertTrue(method_exists('OmiseSchedule', 'retrieve'));
        $this->assertTrue(method_exists('OmiseSchedule', 'reload'));
        $this->assertTrue(method_exists('OmiseSchedule', 'getUrl'));
    }

    /**
     * @test
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
