<?php

use PHPUnit\Framework\TestCase;

class OmiseAccountTest extends TestCase
{
    /**
     * @test
     * OmiseAccount class must be contain some method below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseAccount', 'retrieve'));
        $this->assertTrue(method_exists('OmiseAccount', 'update'));
        $this->assertTrue(method_exists('OmiseAccount', 'reload'));
        $this->assertTrue(method_exists('OmiseAccount', 'getUrl'));
    }

    /**
     * @test
     * Assert that an account object is returned after a successful retrieve.
     */
    public function retrieve_omise_account_object()
    {
        $account = OmiseAccount::retrieve();
        $this->assertArrayHasKey('object', $account);
        $this->assertEquals('account', $account['object']);
    }

    /**
     * @test
     * Assert that the account is successfully updated.
     */
    public function update()
    {
        $account = OmiseAccount::retrieve();
        $account->update(['chain_return_uri' => 'https://www.omise.co']);
        $this->assertArrayHasKey('object', $account);
        $this->assertEquals('account', $account['object']);
        $this->assertEquals('https://www.omise.co', $account['chain_return_uri']);
    }

    /**
     * @test
     * Assert that an account object is returned after a successful reload.
     */
    public function reload()
    {
        $account = OmiseAccount::retrieve();
        $account->reload();
        $this->assertArrayHasKey('object', $account);
        $this->assertEquals('account', $account['object']);
    }
}
