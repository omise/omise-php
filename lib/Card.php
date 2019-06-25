<?php
namespace Omise;

use Omise\Res\OmiseApiResource;
use Omise\Customer;

class Card extends OmiseApiResource
{
    const ENDPOINT = 'cards';

    private $_customerID;

    /**
     * Object representing a card. Cards are retrieved using a `Customer`.
     *
     * @param array  $array
     * @param string $customerID
     */
    public function __construct($array, $customerID)
    {
        parent::__construct();

        $this->_customerID = $customerID;
        $this->refresh($array);
    }

    /**
     * @see Omise\Res\OmiseApiResource::g_reload()
     */
    public function reload()
    {
        parent::g_reload($this->getUrl($this['id']));
    }

    /**
     * @see Omise\Res\OmiseApiResource::g_update()
     */
    public function update($params)
    {
        parent::g_update($this->getUrl($this['id']), $params);
    }

    /**
     * @see Omise\Res\OmiseApiResource::g_destroy()
     */
    public function destroy()
    {
        parent::g_destroy($this->getUrl($this['id']));
    }

    /**
     * @see Omise\Res\OmiseApiResource::isDestroyed()
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
        return \Omise\ApiRequestor::OMISE_API_URL . Customer::ENDPOINT . '/' . $this->_customerID . '/' . self::ENDPOINT . '/' . $cardID;
    }
}
