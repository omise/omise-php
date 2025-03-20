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

        $this->assertIsArray($backends);
        $this->assertIsObject($backends[0]);
    }

    /**
     * @test
     * Assert that a capabilities getBackends method filter with card
     * is returned backend named 'card' after a successful response.
     */
    public function retrieve_card_backend()
    {
        $cardBackends = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterExactName('card')
        );

        $this->assertCount(1, $cardBackends);
        $this->assertEquals('card', $cardBackends[0]->name);
        $this->assertIsArray($cardBackends[0]->currencies);
        $this->assertIsArray($cardBackends[0]->card_brands);
    }

    /**
     * @test
     * Assert that a capabilities getBackends method filter with installment
     * is returned backend named 'installment' after a successful response.
     */
    public function retrieve_installment_backend_list()
    {
        $installmentBackends = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterName('installment')
        );
        foreach ($installmentBackends as $backend) {
            $this->assertStringContainsString('installment', $backend->name);
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
            $this->capabilities->makeBackendFilterName('googlepay')
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
        $this->assertEquals('card', $backends[0]->name);
    }

    /**
     * @test
     * Assert that test mix filter with installment and thb
     * return correct array response.
     */
    public function mix_filter()
    {
        $backends = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterName('installment'),
            $this->capabilities->makeBackendFilterCurrency('thb')
        );
        $this->assertEquals('array', gettype($backends));
        file_put_contents('debug.txt', print_r($backends, true));
    }

    /**
     * @test
     */
    public function filter_by_charge_amount_100000_should_not_include_installment()
    {
        $backend = $this->capabilities->getBackends(
            $this->capabilities->makeBackendFilterName('installment'),
            $this->capabilities->makeBackendFilterChargeAmount(100000)
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
            $this->capabilities->makeBackendFilterName('installment'),
            $this->capabilities->makeBackendFilterChargeAmount(800000)
        );

        $this->assertEquals('array', gettype($backend));
        $this->assertNotEmpty($backend);

        // re-indexing array to make sure it's index starts with 0
        $backend = array_values($backend);
        $this->assertStringStartsWith('installment', $backend[0]->name);
    }

    /**
     * @test
     * Assert the filter shortcuts are available
     */
    public function filter_backend_shortcuts_available()
    {
        $backend = $this->capabilities->getBackends(
            $this->capabilities->backendFilter['currency']('THB'),
            $this->capabilities->backendFilter['exactName']('card'),
            $this->capabilities->backendFilter['name']('installment'),
            $this->capabilities->backendFilter['chargeAmount'](200000),
        );

        $this->assertEquals('array', gettype($backend));
    }
}
