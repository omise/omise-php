<?php
require_once dirname(__FILE__).'/TestConfig.php';

class CapabilitiesTest extends TestConfig
{
    /**
     * @var OmiseCapabilities
     */
    protected $capabilities;

    protected function setUp()
    {
        $this->capabilities = OmiseCapabilities::retrieve();
    }

    /**
     * @test
     * OmiseCapabilities class must be contain some method below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseCapabilities', 'retrieve'));
        $this->assertTrue(method_exists('OmiseCapabilities', 'reload'));
    }

    /**
     * @test
     * Assert that a capabilities object is returned after a successful retrieve.
     */
    public function retrieve_omise_capabilities_object()
    {
        $this->assertEquals('capability', $this->capabilities['object']);
    }
  
    /**
     * @test
     * Assert that a capabilities object is returned after a successful reload.
     */
    public function reload()
    {
        $this->capabilities->reload();

        $this->assertEquals('capability', $this->capabilities['object']);
    }

    /**
     * @test
     */
    public function retrieve_backend_list()
    {
        $backends = $this->capabilities->getBackends();

        $this->assertEquals('array', gettype($backends));
        $this->assertCount(6, $backends);
    }

    /**
     * @test
     */
    public function retrieve_card_backend()
    {
        $cardBackend = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterType('card')
        );

        $this->assertCount(1, $cardBackend);
        $this->assertEquals('card', $cardBackend[0]->type);
        $this->assertEquals('credit_card', $cardBackend[0]->_id);
    }

    /**
     * @test
     */
    public function retrieve_installment_backend_list()
    {
        $installmentBackends = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterType('installment')
        );

        $this->assertCount(5, $installmentBackends);

        foreach ($installmentBackends as $backend) {
            $this->assertEquals('installment', $backend->type);
        }
    }

    /**
     * @test
     */
    public function retrieve_backend_that_doesnot_exist()
    {
        $alipayBackends = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterType('alipay')
        );

        $this->assertEmpty($alipayBackends);
    }

    /**
     * @test
     */
    public function filter_by_currency()
    {
        $backends = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterCurrency('jpy')
        );

        $this->assertCount(1, $backends);
        $this->assertEquals('card', $backends[0]->type);
    }

    /**
     * @test
     */
    public function mix_filter()
    {
        $backends = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterType('installment'),
            $this->capabilities->makeBackendFilterCurrency('thb')
        );

        $this->assertCount(5, $backends);
    }
}
