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
     * Assert that a capabilities getPaymentMethods method is returned an array after a successful response.
     */
    public function retrieve_payment_method_list()
    {
        $paymentMethod = $this->capabilities->getPaymentMethods();

        $this->assertIsArray($paymentMethod);
        $this->assertIsObject($paymentMethod[0]);
    }

    /**
     * @test
     * Assert that a capabilities getPaymentMethods method filter with card
     * is returned payment method named 'card' after a successful response.
     */
    public function retrieve_card_payment_method()
    {
        $cardPaymentMethods = $this->capabilities->getPaymentMethods(
            $this->capabilities->filterPaymentMethodExactName('card')
        );

        $this->assertCount(1, $cardPaymentMethods);
        $this->assertEquals('card', $cardPaymentMethods[0]->name);
        $this->assertIsArray($cardPaymentMethods[0]->currencies);
        $this->assertIsArray($cardPaymentMethods[0]->card_brands);
    }

    /**
     * @test
     * Assert that a capabilities getPaymentMethods method filter with installment
     * is returned payment method named 'installment' after a successful response.
     */
    public function retrieve_installment_payment_method_list()
    {
        $installmentPaymentMethods = $this->capabilities->getPaymentMethods(
            $this->capabilities->filterPaymentMethodName('installment')
        );
        foreach ($installmentPaymentMethods as $method) {
            $this->assertStringContainsString('installment', $method->name);
        }
    }

    /**
     * @test
     * Assert that a capabilities getPaymentMethods method filter with googlepay(which does not exist)
     * must return empty value after a successful response.
     */
    public function retrieve_payment_method_that_doesnot_exist()
    {
        $alipayPaymentMethods = $this->capabilities->getPaymentMethods(
            $this->capabilities->filterPaymentMethodName('googlepay')
        );
        $this->assertEmpty($alipayPaymentMethods);
    }

    /**
     * @test
     * Assert that a capabilities getPaymentMethods method filter with currency(JPY)
     * is returned type 'card' and array response after a successful response.
     */
    public function filter_by_currency()
    {
        $paymentMethods = $this->capabilities->getPaymentMethods(
            $this->capabilities->filterPaymentMethodCurrency('jpy')
        );
        $this->assertEquals('array', gettype($paymentMethods));
        $this->assertEquals('card', $paymentMethods[0]->name);
    }

    /**
     * @test
     * Assert that test mix filter with installment and thb
     * return correct array response.
     */
    public function mix_filter()
    {
        $paymentMethods = $this->capabilities->getPaymentMethods(
            $this->capabilities->filterPaymentMethodName('installment'),
            $this->capabilities->filterPaymentMethodCurrency('thb')
        );
        $this->assertEquals('array', gettype($paymentMethods));
        file_put_contents('debug.txt', print_r($paymentMethods, true));
    }

    /**
     * @test
     */
    public function filter_by_charge_amount_100000_should_not_include_installment()
    {
        $paymentMethods = $this->capabilities->getPaymentMethods(
            $this->capabilities->filterPaymentMethodName('installment'),
            $this->capabilities->filterPaymentMethodChargeAmount(100000)
        );
        $this->assertEquals('array', gettype($paymentMethods));
        $this->assertEmpty($paymentMethods);
    }

    /**
     * @test
     */
    public function filter_by_charge_amount_800000_should_include_installment()
    {
        $paymentMethods = $this->capabilities->getPaymentMethods(
            $this->capabilities->filterPaymentMethodName('installment'),
            $this->capabilities->filterPaymentMethodChargeAmount(800000)
        );

        $this->assertEquals('array', gettype($paymentMethods));
        $this->assertNotEmpty($paymentMethods);

        // re-indexing array to make sure it's index starts with 0
        $paymentMethods = array_values($paymentMethods);
        $this->assertStringStartsWith('installment', $paymentMethods[0]->name);
    }

    /**
     * @test
     * Assert the filter shortcuts are available
     */
    public function filter_payment_method_shortcuts_available()
    {
        $paymentMethods = $this->capabilities->getPaymentMethods(
            $this->capabilities->filterPaymentMethod['currency']('THB'),
            $this->capabilities->filterPaymentMethod['exactName']('card'),
            $this->capabilities->filterPaymentMethod['name']('installment'),
            $this->capabilities->filterPaymentMethod['chargeAmount'](200000),
        );

        $this->assertEquals('array', gettype($paymentMethods));
    }
}
