<?php
require_once dirname(__FILE__).'/TestConfig.php';

use Omise\ApiRequestor;

class ApiRequestorTest extends \TestConfig
{
    /**
     * @var \Omise\ApiRequestor
     */
    private $request;

    public function setUp()
    {
        $this->request = new ApiRequestor;
    }

    /**
     * @test
     */
    public function make_get_request()
    {
        // This endpoint will be resolved to a json-mock file,
        // test/fixtures/*api-version*/api.omise.co/account-get.json
        $url = \Omise\ApiRequestor::OMISE_API_URL . 'account';

        $result = $this->request->get($url, 'skey');

        $this->assertSame('account', $result['object']);
        $this->assertSame('account_test_fixture', $result['id']);
    }

    /**
     * @test
     */
    public function make_post_request()
    {
        // This endpoint will be resolved to a json-mock file,
        // test/fixtures/*api-version*/api.omise.co/charges-post.json
        $url = \Omise\ApiRequestor::OMISE_API_URL . 'charges';

        $result = $this->request->post($url, 'skey', array('amount' => 100000));

        $this->assertSame('charge', $result['object']);
        $this->assertSame('chrg_test_fixture', $result['id']);
    }

    /**
     * @test
     */
    public function make_patch_request()
    {
        // This endpoint will be resolved to a json-mock file,
        // test/fixtures/*api-version*/api.omise.co/charges/chrg_test_fixture-patch.json
        $url = \Omise\ApiRequestor::OMISE_API_URL . 'charges/chrg_test_fixture';

        $result = $this->request->patch($url, 'skey', array('description' => 'mock'));

        $this->assertSame('charge', $result['object']);
        $this->assertSame('chrg_test_fixture', $result['id']);
    }

    /**
     * @test
     */
    public function make_delete_request()
    {
        // This endpoint will be resolved to a json-mock file,
        // test/fixtures/api.omise.co/*api-version*/customers/cust_test_fixture-delete.json
        $url = \Omise\ApiRequestor::OMISE_API_URL . 'customers/cust_test_fixture';

        $result = $this->request->delete($url, 'skey');

        $this->assertArrayHasKey('id', $result);
        $this->assertSame($result['object'], 'customer');
        $this->assertTrue($result['deleted']);
    }

    /**
     * @test
     * @expectedException        \Exception
     * @expectedExceptionMessage Request method "GOT" not supported.
     */
    public function make_unsupported_method_request()
    {
        $this->request->got('http://test', 'skey');
    }
}
