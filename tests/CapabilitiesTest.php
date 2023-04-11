<?php

use PHPUnit\Framework\TestCase;

class CapabilitiesTest extends TestCase
{
    /**
     * @var OmiseCapabilities
     * setup OmiseCapabilities object in capabilities variable.
     */
    protected $capabilities;

    /**
     * @before
     */
    public function setupSharedResources()
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
     * Assert that a capabilities getBackends method is returned an array after a successful response.
     */
    public function retrieve_backend_list()
    {
        $backends = $this->capabilities->getBackends();
        $this->assertEquals('array', gettype($backends));
    }

    /**
     * @test
     * Assert that a capabilities getBackends method filter with card
     * is returned type 'card' and _id 'credit_card' after a successful response.
     */
    public function retrieve_card_backend()
    {
        $cardBackend = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterType('card')
        );
        $this->assertEquals('card', $cardBackend[0]->type);
        $this->assertEquals('credit_card', $cardBackend[0]->_id);
    }

    /**
     * @test
     * Assert that a capabilities getBackends method filter with installment
     * is returned type 'installment' after a successful response.
     */
    public function retrieve_installment_backend_list()
    {
        $installmentBackends = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterType('installment')
        );
        foreach ($installmentBackends as $backend) {
            $this->assertEquals('installment', $backend->type);
        }
    }

    /**
     * @test
     * Assert that a capabilities getBackends method filter with googlepay(which does not exist)
     * must return empty value after a successful response.
     */
    public function retrieve_backend_that_doesnot_exist()
    {
        $alipayBackends = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterType('googlepay')
        );
        $this->assertEmpty($alipayBackends);
    }

    /**
     * @test
     * Assert that a capabilities getBackends method filter with currency(JPY)
     * is returned type 'card' and array response after a successful response.
     */
    public function filter_by_currency()
    {
        $backends = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterCurrency('jpy')
        );
        $this->assertEquals('array', gettype($backends));
        $this->assertEquals('card', $backends[0]->type);
    }

    /**
     * @test
     * Assert that test mix filter with installment and thb
     * return correct array response.
     */
    public function mix_filter()
    {
        $backends = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterType('installment'),
            $this->capabilities->makeBackendFilterCurrency('thb')
        );
        $this->assertEquals('array', gettype($backends));
    }

    /**
     * @test
     */
    public function filter_by_charge_amount_200000_should_not_include_installment()
    {
        $backend = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterType('installment'),
            $this->capabilities->makeBackendFilterChargeAmount(200000)
        );
        $this->assertEquals('array', gettype($backend));
        $this->assertEmpty($backend);
    }

    /**
     * @test
     */
    public function filter_by_charge_amount_800000_should_include_installment()
    {
        $backend = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterType('installment'),
            $this->capabilities->makeBackendFilterChargeAmount(800000)
        );

        $this->assertEquals('array', gettype($backend));
        $this->assertNotEmpty($backend);

        // re-indexing array to make sure it's index starts with 0
        $backend = array_values($backend);
        $this->assertEquals('installment', $backend[0]->type);
    }
}
