<?php

use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Brain\Monkey;

class UnitTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
    }

    public function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
    }
}
