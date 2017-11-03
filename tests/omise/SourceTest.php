<?php
require_once dirname(__FILE__).'/TestConfig.php';

class SourceTest extends TestConfig
{
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
}
