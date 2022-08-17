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
     * @param  array $amount
     *
     * @return OmiseRefund
     */
    public function create($params)
    {
        $result = parent::execute($this->getUrl(), parent::REQUEST_POST, self::getResourceKey(), $params);

        return new OmiseRefund($result, $this->_publickey, $this->_secretkey);
    }

    /**
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
     * @param  string $id
     *
     * @return string
     */
    private function getUrl($id = '')
    {
        return OMISE_API_URL . 'charges/' . $this->_chargeID . '/' . self::ENDPOINT . '/' . $id;
    }
}
