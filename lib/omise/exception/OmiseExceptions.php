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
        $exceptionClassName = 'Omise' . str_replace('_', '', ucwords($array['code'], '_')) . 'Exception';
        return class_exists($exceptionClassName) ? new $exceptionClassName($array['message'], $array) : new OmiseUndefinedException($array['message'], $array);
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

class OmiseAuthenticationFailureException extends OmiseException { }
class OmiseBadRequestException extends OmiseException { }
class OmiseNotFoundException extends OmiseException { }
class OmiseUsedTokenException extends OmiseException { }
class OmiseInvalidCardException extends OmiseException { }
class OmiseInvalidCardTokenException extends OmiseException { }
class OmiseMissingCardException extends OmiseException { }
class OmiseInvalidChargeException extends OmiseException { }
class OmiseFailedCaptureException extends OmiseException { }
class OmiseFailedFraudCheckException extends OmiseException { }
class OmiseFailedRefundException extends OmiseException { }
class OmiseInvalidLinkException extends OmiseException { }
class OmiseInvalidRecipientException extends OmiseException { }
class OmiseInvalidBankAccountException extends OmiseException { }
class OmiseUndefinedException extends OmiseException { }
