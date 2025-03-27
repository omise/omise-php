<?php

use PHPUnit\Framework\TestCase;

class CapabilityTest extends TestCase
{
    /**
     * @var OmiseCapability
     * setup OmiseCapability object in capability variable.
     */
    protected $capability;

    /**
     * @before
     */
    public function setupSharedResources()
    {
        $this->capability = OmiseCapability::retrieve();
    }

    /**
     * @test
     * OmiseCapability class must be contain some method below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseCapability', 'retrieve'));
        $this->assertTrue(method_exists('OmiseCapability', 'reload'));
    }

    /**
     * @test
     * Assert that a capability object is returned after a successful retrieve.
     */
    public function retrieve_omise_capability_object()
    {
        $this->assertEquals('capability', $this->capability['object']);
    }

    /**
     * @test
     * Assert that a capability object is returned after a successful reload.
     */
    public function reload()
    {
        $this->capability->reload();
        $this->assertEquals('capability', $this->capability['object']);
    }

    /**
     * @test
     * Assert that a capability getPaymentMethods method is returned an array after a successful response.
     */
    public function retrieve_payment_method_list()
    {
        $paymentMethod = $this->capability->getPaymentMethods();

        $this->assertIsArray($paymentMethod);
        $this->assertIsObject($paymentMethod[0]);
    }

    /**
     * @test
     * Assert that a capability getPaymentMethods method filter with card
     * is returned payment method named 'card' after a successful response.
     */
    public function retrieve_card_payment_method()
    {
        $cardPaymentMethods = $this->capability->getPaymentMethods(
            $this->capability->filterPaymentMethodExactName('card')
        );

        $this->assertCount(1, $cardPaymentMethods);
        $this->assertEquals('card', $cardPaymentMethods[0]->name);
        $this->assertIsArray($cardPaymentMethods[0]->currencies);
        $this->assertIsArray($cardPaymentMethods[0]->card_brands);
    }

    /**
     * @test
     * Assert that a capability getPaymentMethods method filter with installment
     * is returned payment method named 'installment' after a successful response.
     */
    public function retrieve_installment_payment_method_list()
    {
        $installmentPaymentMethods = $this->capability->getPaymentMethods(
            $this->capability->filterPaymentMethodName('installment')
        );
        foreach ($installmentPaymentMethods as $method) {
            $this->assertStringContainsString('installment', $method->name);
        }
    }

    /**
     * @test
     * Assert that a capability getPaymentMethods method filter with googlepay(which does not exist)
     * must return empty value after a successful response.
     */
    public function retrieve_payment_method_that_doesnot_exist()
    {
        $alipayPaymentMethods = $this->capability->getPaymentMethods(
            $this->capability->filterPaymentMethodName('googlepay')
        );
        $this->assertEmpty($alipayPaymentMethods);
    }

    /**
     * @test
     * Assert that a capability getPaymentMethods method filter with currency (JPY)
     * is returned type 'card' and array response after a successful response.
     */
    public function filter_by_currency()
    {
        $paymentMethods = $this->capability->getPaymentMethods(
            $this->capability->filterPaymentMethodCurrency('jpy')
        );
        $this->assertEquals('array', gettype($paymentMethods));
        $this->assertEquals('card', $paymentMethods[0]->name);
    }

    /**
     * @test
     * Assert that test mix filter with installment and THB
     * returns correct array response.
     */
    public function mix_filter()
    {
        $paymentMethods = $this->capability->getPaymentMethods(
            $this->capability->filterPaymentMethodName('installment'),
            $this->capability->filterPaymentMethodCurrency('thb')
        );
        $this->assertEquals('array', gettype($paymentMethods));
    }

    /**
     * @test
     * Assert that test mix filter with installment and amount less than minimum limit returns empty array.
     */
    public function filter_by_charge_amount_100000_should_not_include_installment()
    {
        $paymentMethods = $this->capability->getPaymentMethods(
            $this->capability->filterPaymentMethodName('installment'),
            $this->capability->filterPaymentMethodChargeAmount(100000)
        );
        $this->assertEquals('array', gettype($paymentMethods));
        $this->assertEmpty($paymentMethods);
    }

    /**
     * @test
     * Assert that test mix filter with installment and amount within limit returns correct array response.
     */
    public function filter_by_charge_amount_800000_should_include_installment()
    {
        $paymentMethods = $this->capability->getPaymentMethods(
            $this->capability->filterPaymentMethodName('installment'),
            $this->capability->filterPaymentMethodChargeAmount(800000)
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
        $paymentMethods = $this->capability->getPaymentMethods(
            $this->capability->filterPaymentMethod['currency']('THB'),
            $this->capability->filterPaymentMethod['exactName']('card'),
            $this->capability->filterPaymentMethod['name']('installment'),
            $this->capability->filterPaymentMethod['chargeAmount'](200000),
        );

        $this->assertEquals('array', gettype($paymentMethods));
    }
}
