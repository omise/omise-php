<?php

use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    /**
     * @test
     * OmiseCard class must be contain some method below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseCard', 'reload'));
        $this->assertTrue(method_exists('OmiseCard', 'update'));
        $this->assertTrue(method_exists('OmiseCard', 'destroy'));
        $this->assertTrue(method_exists('OmiseCard', 'isDestroyed'));
        $this->assertTrue(method_exists('OmiseCard', 'getUrl'));
    }

    /**
     * @test
     * Assert that a list of card object could be successfully retrieved from customer.
     */
    public function retrieve_customer_card_list_object()
    {
        $customer = OmiseCustomer::retrieve(OMISE_CUSTOMER_ID);
        $cards = $customer->cards();
        $this->assertArrayHasKey('object', $cards);
        $this->assertEquals('list', $cards['object']);
    }

    /**
     * @test
     * Assert that a card is could be successfully retrieved from customer.
     */
    public function retrieve_specific_customer_card_object()
    {
        $customer = OmiseCustomer::retrieve(OMISE_CUSTOMER_ID);
        $card = $customer->cards()->retrieve(OMISE_CARD_ID);
        $this->assertArrayHasKey('object', $card);
        $this->assertEquals('card', $card['object']);
    }

    /**
     * @test
     * Assert that a card object is returned after a successful reload.
     */
    public function reload()
    {
        $customer = OmiseCustomer::retrieve(OMISE_CUSTOMER_ID);
        $card = $customer->cards()->retrieve(OMISE_CARD_ID);
        $card->reload();
        $this->assertArrayHasKey('object', $card);
        $this->assertEquals('card', $card['object']);
    }

    /**
     * @test
     * Assert that a card is successfully updated with the given parameters set.
     */
    public function update()
    {
        $customer = OmiseCustomer::retrieve(OMISE_CUSTOMER_ID);
        $card = $customer->cards()->retrieve(OMISE_CARD_ID);
        $card->update([
            'expiration_month' => 11,
            'expiration_year' => date('Y', strtotime('+2 years')),
            'name' => 'Somchai Praset',
            'postal_code' => '10310'
        ]);
        $this->assertArrayHasKey('object', $card);
        $this->assertEquals('card', $card['object']);
    }

    /**
     * @test
     * Assert that a destroyed flag is set after a card is successfully destroyed.
     */
    public function destroy()
    {
        $customer = OmiseCustomer::retrieve(OMISE_CUSTOMER_ID);
        $card = $customer->cards()->retrieve(OMISE_CARD_ID);
        $card->destroy();
        $this->assertArrayHasKey('object', $card);
        $this->assertEquals('card', $card['object']);
        $this->assertTrue($card->isDestroyed());
    }
}
