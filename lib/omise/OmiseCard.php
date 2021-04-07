<?php

class OmiseCard extends OmiseApiResource
{
    const ENDPOINT = 'cards';

    private $_customerID;

    /**
     * Object representing a card. Cards are retrieved using a `Customer`.
     *
     * @param array  $array
     * @param string $customerID
     * @param string $publickey
     * @param string $secretkey
     */
    public function __construct($array, $customerID, $publickey = null, $secretkey = null)
    {
        parent::__construct($publickey, $secretkey);

        $this->_customerID = $customerID;
        $this->refresh($array);
    }

    /**
     * Reloads the card.
     */
    public function reload()
    {
        parent::g_reload($this->getUrl($this['id']));
    }

    /**
     * Updates the card.
     *
     * @param  array  $params
     */
    public function update($params)
    {
        parent::g_update($this->getUrl($this['id']), $params);
    }

    /**
     * Destroys the card.
     */
    public function destroy()
    {
        parent::g_destroy($this->getUrl($this['id']));
    }

    /**
     * Checks whether the card has been destroyed.
     *
     * @return bool
     */
    public function isDestroyed()
    {
        return parent::isDestroyed();
    }

    /**
     * Generates a request URL.
     *
     * @param  string $cardID
     *
     * @return string
     */
    private function getUrl($cardID = '')
    {
        return OMISE_API_URL . OmiseCustomer::ENDPOINT . '/' . $this->_customerID . '/' . self::ENDPOINT . '/' . $cardID;
    }
}
