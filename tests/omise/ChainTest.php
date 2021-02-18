<?php
require_once dirname(__FILE__).'/TestConfig.php';

class ChainTest extends TestConfig
{
    /**
     * @test
     * Assert that OmiseChain class contains the methods below.
     */
    public function method_exists()
    {
        $this->assertTrue(method_exists('OmiseChain', 'retrieve'));
        $this->assertTrue(method_exists('OmiseChain', 'reload'));
        $this->assertTrue(method_exists('OmiseChain', 'revoke'));
        $this->assertTrue(method_exists('OmiseChain', 'getUrl'));
    }

    /**
     * @test
     * Assert that a list of sub-merchant chains could be successfully retrieved.
     */
    public function retrieve_chain_list()
    {
        $chain = OmiseChain::retrieve();

        $this->assertArrayHasKey('object', $chain);
        $this->assertEquals('list', $chain['object']);
    }

    /**
     * @test
     * Assert that a sub-merchant chain could be successfully retrieved.
     */
    public function retrieve_chain_id()
    {
        $chain = OmiseChain::retrieve('acch_test_no1t4tnemucod0e51mo');

        $this->assertArrayHasKey('object', $chain);
        $this->assertEquals('acch_test_no1t4tnemucod0e51mo', $chain['id']);
    }

    /**
     * @test
     * Assert that a list of sub-merchant chains could be successfully reloaded.
     */
    public function reload_chain_list()
    {
        $chain = OmiseChain::retrieve();
        $chain->reload();

        $this->assertArrayHasKey('object', $chain);
        $this->assertEquals('list', $chain['object']);
    }

    /**
     * @test
     * Assert that a sub-merchant chain could be successfully reloaded.
     */
    public function reload_chain_id()
    {
        $chain = OmiseChain::retrieve('acch_test_no1t4tnemucod0e51mo');
        $chain->reload();

        $this->assertArrayHasKey('object', $chain);
        $this->assertEquals('acch_test_no1t4tnemucod0e51mo', $chain['id']);
    }

    /**
     * @test
     * Assert that a sub-merchant chain could be successfully revoked.
     */
    public function revoke_chain()
    {
        $chain = OmiseChain::retrieve('acch_test_no1t4tnemucod0e51mo');
        $chain->revoke();

        $this->assertArrayHasKey('object', $chain);
        $this->assertEquals('acch_test_no1t4tnemucod0e51mo', $chain['id']);
        $this->assertTrue($chain['revoked']);
    }
}
