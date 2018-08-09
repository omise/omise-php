<?php

namespace Omise;

use Omise\Res\OmiseApiResource;

class OmiseCard extends OmiseApiResource
{
    const ENDPOINT = 'cards';

    private $_customerID;

    /**
     * Object representing a card. Cards are retrieved using a `Customer`.
     *
     * @param array $array
     * @param string $customerID
     * @param string $publicKey
     * @param string $secretKey
     */
    public function __construct($array, $customerID, $publicKey = null, $secretKey = null)
    {
        parent::__construct($publicKey, $secretKey);

        $this->_customerID = $customerID;
        $this->refresh($array);
    }

    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::g_reload()
     * @throws Exceptions\OmiseException
     */
    public function reload()
    {
        parent::g_reload($this->getUrl($this['id']));
    }

    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::g_update()
     * @param $params
     * @throws Exceptions\OmiseException
     */
    public function update($params)
    {
        parent::g_update($this->getUrl($this['id']), $params);
    }

    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::g_destroy()
     * @throws Exceptions\OmiseException
     */
    public function destroy()
    {
        parent::g_destroy($this->getUrl($this['id']));
    }

    /**
     * (non-PHPDoc)
     *
     * @see OmiseApiResource::isDestroyed()
     */
    public function isDestroyed()
    {
        return parent::isDestroyed();
    }

    /**
     * @param  string $cardID
     *
     * @return string
     */
    private function getUrl($cardID = '')
    {
        return OMISE_API_URL . OmiseCustomer::ENDPOINT . '/' . $this->_customerID . '/' . self::ENDPOINT . '/' . $cardID;
    }
}
