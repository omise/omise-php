<?php

class OmiseRefundList extends OmiseApiResource
{
    const ENDPOINT = 'refunds';

    private $_chargeID;

    /**
     * @param array  $refunds
     * @param string $chargeID
     * @param string $publickey
     * @param string $secretkey
     */
    public function __construct($refunds, $chargeID, $publickey = null, $secretkey = null)
    {
        parent::__construct($publickey, $secretkey);
        $this->_chargeID = $chargeID;
        $this->refresh($refunds);
    }

    /**
     * Creates a refund.
     *
     * @param  array $params
     *
     * @return OmiseRefund
     */
    public function create($params)
    {
        $result = parent::execute($this->getUrl(), parent::REQUEST_POST, self::getResourceKey(), $params);

        return new OmiseRefund($result, $this->_publickey, $this->_secretkey);
    }

    /**
     * Retrieves a refund.
     *
     * @param  string $id
     *
     * @return OmiseRefund
     */
    public function retrieve($id)
    {
        $result = parent::execute($this->getUrl($id), parent::REQUEST_GET, self::getResourceKey());

        return new OmiseRefund($result, $this->_publickey, $this->_secretkey);
    }

    /**
     * Generates a request URL.
     *
     * @param  string $refundID
     *
     * @return string
     */
    private function getUrl($refundID = '')
    {
        return OMISE_API_URL . OmiseCharge::ENDPOINT . '/' . $this->_chargeID . '/' . self::ENDPOINT . '/' . $refundID;
    }
}
