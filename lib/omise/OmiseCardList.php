<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';
require_once dirname(__FILE__).'/OmiseCard.php';

class OmiseCardList extends OmiseApiResource
{
    const ENDPOINT = 'cards';

    private $_customerID;
  
    /**
     * @param array  $cards
     * @param string $customerID
     * @param string $publickey
     * @param string $secretkey
     */
    public function __construct($cards, $customerID, $options = array(), $publickey = null, $secretkey = null)
    {
        parent::__construct($publickey, $secretkey);
        $this->_customerID = $customerID;

        if (is_array($options) && ! empty($options)) {
            parent::g_reload($this->getUrl('?'.http_build_query($options)));
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
     */
    public function retrieve($id)
    {
        $result = parent::execute($this->getUrl($id), parent::REQUEST_GET, self::getResourceKey());

        return new OmiseCard($result, $this->_customerID, $this->_publickey, $this->_secretkey);
    }
  

    /**
     * @param  string $id
     *
     * @return string
     */
    private function getUrl($id = '')
    {
        return OMISE_API_URL.'customers/'.$this->_customerID.'/'.self::ENDPOINT.'/'.$id;
    }
}
