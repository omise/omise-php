<?php

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
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

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
class OmiseAuthenticationFailureException extends OmiseException { }

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
class OmiseNotFoundException extends OmiseException { }

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
class OmiseUsedTokenException extends OmiseException { }

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
class OmiseInvalidCardException extends OmiseException { }

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
class OmiseInvalidCardTokenException extends OmiseException { }

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
class OmiseMissingCardException extends OmiseException { }

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
class OmiseInvalidChargeException extends OmiseException { }

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
class OmiseFailedCaptureException extends OmiseException { }

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
class OmiseFailedFraudCheckException extends OmiseException { }

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
class OmiseInvalidRecipientException extends OmiseException { }

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
class OmiseInvalidBankAccountException extends OmiseException { }

/**
 * @deprecated 3.0.0 not recommended, please implement with namespace approach.
 */
class OmiseUndefinedException extends OmiseException { }
