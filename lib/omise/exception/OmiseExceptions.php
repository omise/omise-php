<?php

class OmiseException extends Exception
{
    private $_omiseError = null;

    public function __construct($message = null, $omiseError = null)
    {
        parent::__construct($message);
        $this->setOmiseError($omiseError);
    }

    /**
     * Returns an instance of an exception class from the given error response.
     *
     * @param  array $array
     *
     * @return OmiseAuthenticationFailureException|OmiseNotFoundException|OmiseUsedTokenException|OmiseInvalidCardException|OmiseInvalidCardTokenException|OmiseMissingCardException|OmiseInvalidChargeException|OmiseFailedCaptureException|OmiseFailedFraudCheckException|OmiseUndefinedException
     */
    public static function getInstance($array)
    {
        switch ($array['code']) {
            case 'authentication_failure':
                return new OmiseAuthenticationFailureException($array['message'], $array);

            case 'bad_request':
                return new OmiseBadRequestException($array['message'], $array);

            case 'not_found':
                return new OmiseNotFoundException($array['message'], $array);

            case 'used_token':
                return new OmiseUsedTokenException($array['message'], $array);

            case 'invalid_card':
                return new OmiseInvalidCardException($array['message'], $array);

            case 'invalid_card_token':
                return new OmiseInvalidCardTokenException($array['message'], $array);

            case 'missing_card':
                return new OmiseMissingCardException($array['message'], $array);

            case 'invalid_charge':
                return new OmiseInvalidChargeException($array['message'], $array);

            case 'failed_capture':
                return new OmiseFailedCaptureException($array['message'], $array);

            case 'failed_fraud_check':
                return new OmiseFailedFraudCheckException($array['message'], $array);

            case 'failed_refund':
                return new OmiseFailedRefundException($array['message'], $array);

            case 'invalid_link':
                return new OmiseInvalidLinkException($array['message'], $array);

            case 'invalid_recipient':
                return new OmiseInvalidRecipientException($array['message'], $array);

            case 'invalid_bank_account':
                return new OmiseInvalidBankAccountException($array['message'], $array);

            default:
                return new OmiseUndefinedException($array['message'], $array);
        }
    }

    /**
     * Sets the error.
     *
     * @param OmiseError $omiseError
     */
    public function setOmiseError($omiseError)
    {
        $this->_omiseError = $omiseError;
    }

    /**
     * Gets the OmiseError object. This method will return null if an error happens outside of the API. (For example, due to HTTP connectivity problem.)
     * Please see https://docs.omise.co/api/errors/ for a list of possible errors.
     *
     * @return OmiseError
     */
    public function getOmiseError()
    {
        return $this->_omiseError;
    }
}

class OmiseAuthenticationFailureException extends OmiseException
{
}
class OmiseBadRequestException extends OmiseException
{
}
class OmiseNotFoundException extends OmiseException
{
}
class OmiseUsedTokenException extends OmiseException
{
}
class OmiseInvalidCardException extends OmiseException
{
}
class OmiseInvalidCardTokenException extends OmiseException
{
}
class OmiseMissingCardException extends OmiseException
{
}
class OmiseInvalidChargeException extends OmiseException
{
}
class OmiseFailedCaptureException extends OmiseException
{
}
class OmiseFailedFraudCheckException extends OmiseException
{
}
class OmiseFailedRefundException extends OmiseException
{
}
class OmiseInvalidLinkException extends OmiseException
{
}
class OmiseInvalidRecipientException extends OmiseException
{
}
class OmiseInvalidBankAccountException extends OmiseException
{
}
class OmiseUndefinedException extends OmiseException
{
}
