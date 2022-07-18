<?php

use PHPUnit\Framework\TestCase;

class SourceTest extends TestCase
{
    /**
    * @test
    * OmiseSource class must be contain some method below.
    */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseSource', 'retrieve'));
        $this->assertTrue(method_exists('OmiseSource', 'create'));
    }

    /**
     * @test
     */
    public function create()
    {
        $parameter = [
            'type' => 'bill_payment_tesco_lotus',
            'amount' => 15000,
            'currency' => 'thb'
        ];
        $source = OmiseSource::create($parameter);
        $this->assertArrayHasKey('object', $source);
        $this->assertEquals('source', $source['object']);
    }

    /**
    * @test
    */
    public function retrieve_specifics_source_object()
    {
        $parameter = [
            'type' => 'bill_payment_tesco_lotus',
            'amount' => 15000,
            'currency' => 'thb'
        ];
        $source = OmiseSource::create($parameter);
        $source = OmiseSource::retrieve($source['id']);
        $this->assertArrayHasKey('object', $source);
        $this->assertEquals('source', $source['object']);
    }
}
