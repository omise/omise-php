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
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_reload()
     */
    public function reload()
    {
        parent::g_reload($this->getUrl($this['id']));
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_update()
     */
    public function update($params)
    {
        parent::g_update($this->getUrl($this['id']), $params);
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_destroy()
     */
    public function destroy()
    {
        parent::g_destroy($this->getUrl($this['id']));
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::isDestroyed()
     */
    public function isDestroyed()
    {
        return parent::isDestroyed();
    }
}
