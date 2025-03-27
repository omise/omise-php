<?php

use PHPUnit\Framework\TestCase;
use Omise\Traits\ChargeTrait;

class OmiseExceptionTest extends TestCase
{
    /**
     * use charge trait to create a charge using
     * default customer id and card id.
     */
    use ChargeTrait;

    /**
     * @test
     * ----- Test OmiseException::getInstance() -----
     * This assert should throw an Exception depend on what error code be.
     * And Exception message should be the same thing with error message that pass into 'message' parameter.
     */
    public function authentication_failure_exception()
    {
        $this->expectException(OmiseAuthenticationFailureException::class);
        $this->expectExceptionMessage('authentication failed');
        $mock = [
            'object' => 'error',
            'location' => 'https://docs.omise.co/api/errors#authentication-failure',
            'code' => 'authentication_failure',
            'message' => 'authentication failed'
        ];

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * Assert that OmiseBadRequestException is throw in bad request
     */
    public function omise_bad_request_exception()
    {
        $this->expectException(OmiseBadRequestException::class);
        $this->expectExceptionMessage('offsite is not valid');
        $mock = [
            'object' => 'error',
            'location' => 'https://www.omise.co/api-errors#bad-request',
            'code' => 'bad_request',
            'message' => 'offsite is not valid'
        ];

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * Assert that OmiseNotFoundException is throw on not_found response code
     */
    public function not_found_exception()
    {
        $this->expectException(OmiseNotFoundException::class);
        $this->expectExceptionMessage('customer cust_test_000000000000 was not found');
        $mock = [
            'object' => 'error',
            'location' => 'https://docs.omise.co/api/errors#not-found',
            'code' => 'not_found',
            'message' => 'customer cust_test_000000000000 was not found'
        ];

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * Assert that OmiseUsedTokenException is throw on used_token response code
     */
    public function used_token_exception()
    {
        $this->expectException(OmiseUsedTokenException::class);
        $this->expectExceptionMessage('token was already used');
        $mock = [
            'object' => 'error',
            'location' => 'https://docs.omise.co/api/errors#used-token',
            'code' => 'used_token',
            'message' => 'token was already used'
        ];

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * Assert that OmiseInvalidCardException is throw on invalid_card response code
     */
    public function invalid_card_exception()
    {
        $this->expectException(OmiseInvalidCardException::class);
        $this->expectExceptionMessage('number is invalid and brand not supported (unknown)');
        $mock = [
            'object' => 'error',
            'location' => 'https://docs.omise.co/api/errors#invalid-card',
            'code' => 'invalid_card',
            'message' => 'number is invalid and brand not supported (unknown)'
        ];

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * Assert that OmiseInvalidCardTokenException is throw on invalid_card_token response code
     */
    public function invalid_card_token_exception()
    {
        $this->expectException(OmiseInvalidCardTokenException::class);
        $this->expectExceptionMessage('invalid card token');
        $mock = [
            'object' => 'error',
            'location' => 'https://docs.omise.co/api/errors#invalid-card-token',
            'code' => 'invalid_card_token',
            'message' => 'invalid card token'
        ];

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * Assert that OmiseInvalidLinkException is throw on invalid_link response code
     */
    public function invalid_link_exception()
    {
        $this->expectException(OmiseInvalidLinkException::class);
        $this->expectExceptionMessage('amount must be less than or equal to 1000000.0');
        $mock = [
            'object' => 'error',
            'location' => 'https://www.omise.co/api-errors#invalid-link',
            'code' => 'invalid_link',
            'message' => 'amount must be less than or equal to 1000000.0'
        ];

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * Assert that OmiseMissingCardException is throw on missing_card response code
     */
    public function missing_card_exception()
    {
        $this->expectException(OmiseMissingCardException::class);
        $this->expectExceptionMessage('request contains no card parameters');
        $mock = [
            'object' => 'error',
            'location' => 'https://docs.omise.co/api/errors#missing-card',
            'code' => 'missing_card',
            'message' => 'request contains no card parameters'
        ];

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * Assert that OmiseInvalidChargeException is throw on invalid_charge response code
     */
    public function invalid_charge_exception()
    {
        $this->expectException(OmiseInvalidChargeException::class);
        $this->expectExceptionMessage('currency is currently not supported and amount is not a number');
        $mock = [
            'object' => 'error',
            'location' => 'https://docs.omise.co/api/errors#invalid-charge',
            'code' => 'invalid_charge',
            'message' => 'currency is currently not supported and amount is not a number'
        ];

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * Assert that OmiseFailedCaptureException is throw on failed_capture response code
     */
    public function failed_capture_exception()
    {
        $this->expectException(OmiseFailedCaptureException::class);
        $this->expectExceptionMessage('Charge is not authorized');
        $mock = [
            'object' => 'error',
            'location' => 'https://docs.omise.co/api/errors#failed-capture',
            'code' => 'failed_capture',
            'message' => 'Charge is not authorized'
        ];

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * Assert that OmiseFailedRefundException is throw on failed_refund response code
     */
    public function failed_refund_exception()
    {
        $this->expectException(OmiseFailedRefundException::class);
        $this->expectExceptionMessage('amount is not a number');
        $mock = [
            'object' => 'error',
            'location' => 'https://www.omise.co/api-errors#failed-refund',
            'code' => 'failed_refund',
            'message' => 'amount is not a number'
        ];

        throw OmiseException::getInstance($mock);
    }

    /**
     * @test
     * Assert that OmiseUndefinedException is throw on something_strange response code
     */
    public function undefined_exception()
    {
        $this->expectException(OmiseUndefinedException::class);
        $this->expectExceptionMessage('Strange case, don\'t know why?');
        $mock = [
            'object' => 'error',
            'location' => '',
            'code' => 'something_strange',
            'message' => 'Strange case, don\'t know why?'
        ];

        throw OmiseException::getInstance($mock);
    }
}
