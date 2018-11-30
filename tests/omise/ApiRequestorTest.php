<?php
require_once dirname(__FILE__).'/TestConfig.php';

class ApiRequestorTest extends \TestConfig
{
    /**
     * @var \Omise\ApiRequestor
     */
    private $apiRequestor;

    public function setUp()
    {
        $this->apiRequestor = new \Omise\ApiRequestor;
    }

    /**
     * @test
     */
    public function make_get_request()
    {
        // This endpoint will be resolved to a json-mock file,
        // test/fixtures/api.omise.co/account-get.json
        $url = \Omise\ApiRequestor::OMISE_API_URL . 'account';

        $result = $this->apiRequestor->get($url, 'secretkey');

        $this->assertArrayHasKey('id', $result);
        $this->assertSame($result['object'], 'account');
        $this->assertSame($result['id'], 'acct_4yyvy93tmab34q2ywlo');
    }

    /**
     * @test
     */
    public function make_post_request()
    {
        // This endpoint will be resolved to a json-mock file,
        // test/fixtures/api.omise.co/charges-post.json
        $url = \Omise\ApiRequestor::OMISE_API_URL . 'charges';

        $result = $this->apiRequestor->post($url, 'secretkey', array('amount' => 100000));

        $this->assertArrayHasKey('id', $result);
        $this->assertSame($result['object'], 'charge');
        $this->assertSame($result['id'], 'chrg_test_4zmrjgxdh4ycj2qncoj');
    }

    /**
     * @test
     */
    public function make_patch_request()
    {
        // This endpoint will be resolved to a json-mock file,
        // test/fixtures/api.omise.co/charges/chrg_test_4zmrjgxdh4ycj2qncoj-patch.json
        $url = \Omise\ApiRequestor::OMISE_API_URL . 'charges/chrg_test_4zmrjgxdh4ycj2qncoj';

        $result = $this->apiRequestor->patch($url, 'secretkey', array('description' => 'mock'));

        $this->assertArrayHasKey('id', $result);
        $this->assertSame($result['object'], 'charge');
        $this->assertSame($result['id'], 'chrg_test_4zmrjgxdh4ycj2qncoj');
    }

    /**
     * @test
     */
    public function make_delete_request()
    {
        // This endpoint will be resolved to a json-mock file,
        // test/fixtures/api.omise.co/customers/cust_test_4zmrjg2hct06ybwobqc-delete.json
        $url = \Omise\ApiRequestor::OMISE_API_URL . 'customers/cust_test_4zmrjg2hct06ybwobqc';

        $result = $this->apiRequestor->delete($url, 'secretkey');

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
        $this->apiRequestor->got('http://test', 'secretkey');
    }
}
