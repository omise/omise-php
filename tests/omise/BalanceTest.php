<?php
require_once dirname(__FILE__).'/TestConfig.php';

use Omise\Balance;

class BalanceTest extends TestConfig
{
    /**
     * @test
     */
    public function retrieve()
    {
        $balance = Balance::retrieve();

        $this->assertSame('balance', $balance['object']);
        $this->assertSame(51861467, $balance['transferable']);
    }

    /**
     * @test
     */
    public function reload()
    {
        $balance = Balance::retrieve();
        $balance->reload();

        $this->assertSame('balance', $balance['object']);
        $this->assertSame(51861467, $balance['transferable']);
    }
}
