<?php

use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{
    /**
     * @test
     * OmiseToken should contain some method like below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseToken', 'retrieve'));
        $this->assertTrue(method_exists('OmiseToken', 'create'));
        $this->assertTrue(method_exists('OmiseToken', 'reload'));
        $this->assertTrue(method_exists('OmiseToken', 'getUrl'));
    }

    /**
     * @test
     * Assert that a token is successfully created with the given parameters set.
     */
    public function create()
    {
        $token = OmiseToken::create([
            'card' => [
                'name' => 'Zin Kyaw Kyaw',
                'number' => '4242424242424242',
                'expiration_month' => 10,
                'expiration_year' => date('Y', strtotime('+2 years')),
                'city' => 'Bangkok',
                'postal_code' => '10320',
                'security_code' => 123
            ]
        ]);
        $this->assertArrayHasKey('object', $token);
        $this->assertEquals('token', $token['object']);
    }

    /**
     * @test
     * Assert that a token object is returned after a successful retrieve.
     */
    public function retrieve()
    {
        $token = OmiseToken::create([
            'card' => [
                'name' => 'Zin Kyaw Kyaw',
                'number' => '4242424242424242',
                'expiration_month' => 10,
                'expiration_year' => date('Y', strtotime('+2 years')),
                'city' => 'Bangkok',
                'postal_code' => '10320',
                'security_code' => 123
            ]
        ]);
        $token = OmiseToken::retrieve($token['id']);
        $this->assertArrayHasKey('object', $token);
        $this->assertEquals('token', $token['object']);
    }

    /**
    * @test
    * Assert that a token object is returned after a successful reload.
    */
    public function reload()
    {
        $token = OmiseToken::create([
            'card' => [
                'name' => 'Zin Kyaw Kyaw',
                'number' => '4242424242424242',
                'expiration_month' => 10,
                'expiration_year' => date('Y', strtotime('+2 years')),
                'city' => 'Bangkok',
                'postal_code' => '10320',
                'security_code' => 123
            ]
        ]);
        $token->reload();
        $this->assertArrayHasKey('object', $token);
        $this->assertEquals('token', $token['object']);
    }
}
