<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseRefundList extends OmiseApiResource
{
    const ENDPOINT = 'refunds';

    private $_chargeID;

    /**
     * @param array $refunds
     * @param string $chargeID
     * @param string $publicKey
     * @param string $secretKey
     */
    public function __construct($refunds, $chargeID, $publicKey = null, $secretKey = null)
    {
        parent::__construct($publicKey, $secretKey);
        $this->_chargeID = $chargeID;
        $this->refresh($refunds);
    }

    /**
     * @param $params
     * @return OmiseRefund
     * @throws Exceptions\OmiseAuthenticationFailureException
     * @throws Exceptions\OmiseException
     * @throws Exceptions\OmiseFailedCaptureException
     * @throws Exceptions\OmiseFailedFraudCheckException
     * @throws Exceptions\OmiseInvalidCardException
     * @throws Exceptions\OmiseInvalidCardTokenException
     * @throws Exceptions\OmiseInvalidChargeException
     * @throws Exceptions\OmiseMissingCardException
     * @throws Exceptions\OmiseNotFoundException
     * @throws Exceptions\OmiseUndefinedException
     * @throws Exceptions\OmiseUsedTokenException
     */
    public function create($params)
    {
        $result = parent::execute($this->getUrl(), parent::REQUEST_POST, self::getResourceKey(), $params);

        return new OmiseRefund($result, $this->_publicKey, $this->_secretKey);
    }

    /**
     * @param  string $id
     *
     * @return OmiseRefund
     * @throws Exceptions\OmiseAuthenticationFailureException
     * @throws Exceptions\OmiseException
     * @throws Exceptions\OmiseFailedCaptureException
     * @throws Exceptions\OmiseFailedFraudCheckException
     * @throws Exceptions\OmiseInvalidCardException
     * @throws Exceptions\OmiseInvalidCardTokenException
     * @throws Exceptions\OmiseInvalidChargeException
     * @throws Exceptions\OmiseMissingCardException
     * @throws Exceptions\OmiseNotFoundException
     * @throws Exceptions\OmiseUndefinedException
     * @throws Exceptions\OmiseUsedTokenException
     */
    public function retrieve($id)
    {
        $result = parent::execute($this->getUrl($id), parent::REQUEST_GET, self::getResourceKey());

        return new OmiseRefund($result, $this->_publicKey, $this->_secretKey);
    }

    /**
     * @param  string $id
     *
     * @return string
     */
    private function getUrl($id = '')
    {
        return OMISE_API_URL . 'charges/' . $this->_chargeID . '/' . self::ENDPOINT . '/' . $id;
    }
}
