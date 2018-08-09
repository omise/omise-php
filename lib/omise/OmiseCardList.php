<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseCardList extends OmiseApiResource
{
    const ENDPOINT = 'cards';

    private $_customerID;

    /**
     * @param array $cards
     * @param string $customerID
     * @param array $options
     * @param string $publicKey
     * @param string $secretKey
     * @throws Exceptions\OmiseException
     */
    public function __construct($cards, $customerID, $options = array(), $publicKey = null, $secretKey = null)
    {
        parent::__construct($publicKey, $secretKey);
        $this->_customerID = $customerID;

        if (is_array($options) && !empty($options)) {
            parent::g_reload($this->getUrl('?' . http_build_query($options)));
        } else {
            $this->refresh($cards);
        }
    }

    /**
     * retrieve a card
     *
     * @param  string $id
     *
     * @return OmiseCard
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

        return new OmiseCard($result, $this->_customerID, $this->_publicKey, $this->_secretKey);
    }


    /**
     * @param  string $id
     *
     * @return string
     */
    private function getUrl($id = '')
    {
        return OMISE_API_URL . 'customers/' . $this->_customerID . '/' . self::ENDPOINT . '/' . $id;
    }
}
