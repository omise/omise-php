<?php
namespace Omise;

use Omise\Res\OmiseApiResource;
use Omise\Card;

class CardList extends OmiseApiResource
{
    const ENDPOINT = 'cards';

    private $_customerID;
  
    /**
     * @param array  $cards
     * @param string $customerID
     */
    public function __construct($cards, $customerID)
    {
        parent::__construct();
        $this->_customerID = $customerID;
        $this->refresh($cards);
    }
  
    /**
     * retrieve a card
     *
     * @param  string $id
     *
     * @return Omise\Card
     */
    public function retrieve($id)
    {
        $result = $this->apiRequestor->get($this->getUrl($id), self::getResourceKey());

        return new Card($result, $this->_customerID);
    }
  

    /**
     * @param  string $id
     *
     * @return string
     */
    private function getUrl($id = '')
    {
        return \Omise\ApiRequestor::OMISE_API_URL . 'customers/' . $this->_customerID . '/' . self::ENDPOINT . '/' . $id;
    }
}
