<?php
require_once dirname(__FILE__).'/../TestConfig.php';

if (version_compare(phpversion(), '5.3.2') >= 0 && file_exists(dirname(__FILE__).'/../../../vendor/autoload.php')) {
    require_once dirname(__FILE__).'/../../../vendor/autoload.php';
} else {
    require_once dirname(__FILE__).'/../../../lib/Omise.php';
}

class OmiseExceptionTest extends PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        /** Do Nothing **/
    }

    public function setUp()
    {
        /** Do Nothing **/
    }

    /**
     * @test
     * ----- Test OmiseException::getInstance() -----
     * This assert should throw an Exception depend on what error code be.
     * And Exception message should be the same thing with error message that pass into 'message' parameter.
     *
     * @expectedException         OmiseAuthenticationFailureException
     * @expectedExceptionMessage  authentication failed
     */
    public function authentication_failure_exception()
    {
        $mock = array('object'    => 'error',
                      'location'  => 'https://docs.omise.co/api/errors#authentication-failure',
                      'code'      => 'authentication_failure',
                      'message'   => 'authentication failed');

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * @expectedException         OmiseBadRequestException
     * @expectedExceptionMessage  offsite is not valid
     */
    public function omise_bad_request_exception()
    {
        $mock = array('object'    => 'error',
                      'location'  => 'https://www.omise.co/api-errors#bad-request',
                      'code'      => 'bad_request',
                      'message'   => 'offsite is not valid');

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * @expectedException         OmiseNotFoundException
     * @expectedExceptionMessage  customer cust_test_000000000000 was not found
     */
    public function not_found_exception()
    {
        $mock = array('object'    => 'error',
                      'location'  => 'https://docs.omise.co/api/errors#not-found',
                      'code'      => 'not_found',
                      'message'   => 'customer cust_test_000000000000 was not found');

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * @expectedException         OmiseUsedTokenException
     * @expectedExceptionMessage  token was already used
     */
    public function used_token_exception()
    {
        $mock = array('object'    => 'error',
                      'location'  => 'https://docs.omise.co/api/errors#used-token',
                      'code'      => 'used_token',
                      'message'   => 'token was already used');

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * @expectedException         OmiseInvalidCardException
     * @expectedExceptionMessage  number is invalid and brand not supported (unknown)
     */
    public function invalid_card_exception()
    {
        $mock = array('object'    => 'error',
                      'location'  => 'https://docs.omise.co/api/errors#invalid-card',
                      'code'      => 'invalid_card',
                      'message'   => 'number is invalid and brand not supported (unknown)');

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * @expectedException         OmiseInvalidCardTokenException
     * @expectedExceptionMessage  invalid card token
     */
    public function invalid_card_token_exception()
    {
        $mock = array('object'    => 'error',
                      'location'  => 'https://docs.omise.co/api/errors#invalid-card-token',
                      'code'      => 'invalid_card_token',
                      'message'   => 'invalid card token');

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * @expectedException         OmiseInvalidLinkException
     * @expectedExceptionMessage  amount must be less than or equal to 1000000.0
     */
    public function invalid_link_exception()
    {
        $mock = array('object'    => 'error',
                      'location'  => 'https://www.omise.co/api-errors#invalid-link',
                      'code'      => 'invalid_link',
                      'message'   => 'amount must be less than or equal to 1000000.0');

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * @expectedException         OmiseMissingCardException
     * @expectedExceptionMessage  request contains no card parameters
     */
    public function missing_card_exception()
    {
        $mock = array('object'    => 'error',
                      'location'  => 'https://docs.omise.co/api/errors#missing-card',
                      'code'      => 'missing_card',
                      'message'   => 'request contains no card parameters');

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * @expectedException         OmiseInvalidChargeException
     * @expectedExceptionMessage  currency is currently not supported and amount is not a number
     */
    public function invalid_charge_exception()
    {
        $mock = array('object'    => 'error',
                      'location'  => 'https://docs.omise.co/api/errors#invalid-charge',
                      'code'      => 'invalid_charge',
                      'message'   => 'currency is currently not supported and amount is not a number');

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * @expectedException         OmiseFailedCaptureException
     * @expectedExceptionMessage  Charge is not authorized
     */
    public function failed_capture_exception()
    {
        $mock = array('object'    => 'error',
                      'location'  => 'https://docs.omise.co/api/errors#failed-capture',
                      'code'      => 'failed_capture',
                      'message'   => 'Charge is not authorized');

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * @expectedException         OmiseFailedRefundException
     * @expectedExceptionMessage  amount is not a number
     */
    public function failed_refund_exception()
    {
        $mock = array('object'    => 'error',
                      'location'  => 'https://www.omise.co/api-errors#failed-refund',
                      'code'      => 'failed_refund',
                      'message'   => 'amount is not a number');

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * @expectedException         OmiseUndefinedException
     * @expectedExceptionMessage  Strange case, don't know why?
     */
    public function undefined_exception()
    {
        $mock = array('object'    => 'error',
                      'location'  => '',
                      'code'      => 'something_strange',
                      'message'   => 'Strange case, don\'t know why?');

        throw OmiseException::getInstance($mock);
    }

    public function tearDown()
    {
        /** Do Nothing **/
    }

    public static function tearDownAfterClass()
    {
        /** Do Nothing **/
    }
}
