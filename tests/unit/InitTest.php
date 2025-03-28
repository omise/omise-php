<?php

include __DIR__ . '/_index.php';

use PHPUnit\Framework\TestCase;

/**
 * this test is required to include _index.php
 * which has OMISE API KEYS and customer setup function.
 * Since php unit allow file to include only once,
 * we create a mock test to include _index.php file here
 */
class InitTest extends TestCase
{
    public function test_mock()
    {
        $this->assertTrue(true);
    }
}
