<?php
require_once dirname(__FILE__).'/../../TestConfig.php';

class HandlerTest extends \TestConfig
{
    /**
     * @var \Omise\Http\Response\Handler
     */
    private $responseHandler;

    public function setUp()
    {
        $this->responseHandler = new \Omise\Http\Response\Handler;
    }

    /**
     * @test
     * @expectedException \OmiseUndefinedException
     */
    public function handle_an_undefined_error_obbject()
    {
        $this->responseHandler->handle('{"object":"error","code":"undefined_one"}');
    }

    /**
     * @test
     * @expectedException \OmiseAuthenticationFailureException
     */
    public function handle_an_error_authentication_failure()
    {
        $this->responseHandler->handle('{"object":"error","code":"authentication_failure"}');
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function throw_an_exception_if_response_is_a_string()
    {
        $this->responseHandler->handle('string');
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function throw_an_exception_if_response_is_a_number()
    {
        $this->responseHandler->handle(100);
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function throw_an_exception_if_response_is_a_boolean()
    {
        $this->responseHandler->handle(true);
    }

    /**
     * @test
     */
    public function valid_json_response()
    {
        $result = $this->responseHandler->handle('{"object":"account","id":"acct_test"}');

        $this->assertTrue(is_array($result));
        $this->assertArrayHasKey('id', $result);
        $this->assertSame($result['id'], 'acct_test');
    }
}
