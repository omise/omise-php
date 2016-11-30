<?php

require_once dirname(__FILE__).'/res/OmiseApiResource.php';
require_once dirname(__FILE__).'/OmiseRefundList.php';

class OmiseCharge extends OmiseApiResource
{
    const ENDPOINT = 'charges';

    /**
     * Retrieves a charge.
     *
     * @param  string $id
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseCharge
     */
    public static function retrieve($id = '', $publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_reload()
     */
    public function reload()
    {
        if ($this['object'] === 'charge') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
    }

    /**
     * Creates a new charge.
     *
     * @param  array  $params
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseCharge
     */
    public static function create($params, $publickey = null, $secretkey = null)
    {
        return parent::g_create(get_class(), self::getUrl(), $params, $publickey, $secretkey);
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_update()
     */
    public function update($params)
    {
        parent::g_update(self::getUrl($this['id']), $params);
    }

    /**
     * Captures a charge.
     *
     * @return OmiseCharge
     */
    public function capture()
    {
        $result = parent::execute(self::getUrl($this['id']).'/capture', parent::REQUEST_POST, parent::getResourceKey());
        $this->refresh($result);

        return $this;
    }

    /**
     * Reverses a charge.
     *
     * @return OmiseCharge
     */
    public function reverse()
    {
        $result = parent::execute(self::getUrl($this['id']).'/reverse', parent::REQUEST_POST, parent::getResourceKey());
        $this->refresh($result);

        return $this;
    }

    /**
     * list refunds
     *
     * @return OmiseRefundList
     */
    public function refunds()
    {
        $result = parent::execute(self::getUrl($this['id']).'/refunds', parent::REQUEST_GET, parent::getResourceKey());

        return new OmiseRefundList($result, $this['id'], $this->_publickey, $this->_secretkey);
    }

    /**
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return OMISE_API_URL.self::ENDPOINT.'/'.$id;
    }
}
