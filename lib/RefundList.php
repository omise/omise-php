<?php
namespace Omise;

use Omise\Res\OmiseApiResource;
use Omise\Refund;

class RefundList extends OmiseApiResource
{
    const ENDPOINT = 'refunds';

    private $_chargeID;

    /**
     * @param array  $refunds
     * @param string $chargeID
     */
    public function __construct($refunds, $chargeID)
    {
        parent::__construct();
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
        $result = $this->apiRequestor->post($this->getUrl(), self::getResourceKey(), $params);

        return new Refund($result);
    }

    /**
     * @param  string $id
     *
     * @return OmiseRefund
     */
    public function retrieve($id)
    {
        $result = $this->apiRequestor->get($this->getUrl($id), self::getResourceKey());

        return new Refund($result);
    }

    /**
     * @param  string $id
     *
     * @return string
     */
    private function getUrl($id = '')
    {
        return \Omise\ApiRequestor::OMISE_API_URL . 'charges/' . $this->_chargeID . '/' . self::ENDPOINT . '/' . $id;
    }
}
