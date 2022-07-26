<?php
require_once dirname(__FILE__).'/TestConfig.php';

class SourceTest extends TestConfig
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
        $parameter = array(
            'type'     => 'bill_payment_tesco_lotus',
            'amount'   => 15000,
            'currency' => 'thb'
        );

        $source = OmiseSource::create($parameter);

        $this->assertArrayHasKey('object', $source);
        $this->assertEquals('source', $source['object']);
    }

     /**
     * @test
     */
    public function retrieve_specifics_source_object()
    {
        $source = OmiseSource::retrieve('src_test_no1t4tnemucod0e51mo');

        $this->assertArrayHasKey('object', $source);
        $this->assertEquals('source', $source['object']);
    }
}
