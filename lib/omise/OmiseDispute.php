<?php

class OmiseDispute extends OmiseApiResource
{
    const ENDPOINT = 'disputes';

    /**
     * Creates a new dispute.
     *
     * @param  array  $params
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseDispute
     */
    public static function create($charge, $params, $publickey = null, $secretkey = null)
    {
        $url = OMISE_API_URL . 'charges/' . $charge['id'] . '/' . self::ENDPOINT;

        return parent::g_create($url, $params, $publickey, $secretkey);
    }

    /**
     * Retrieves a dispute.
     *
     * @param  string $id
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseDispute
     */
    public static function retrieve($id = '', $publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(self::getUrl($id), $publickey, $secretkey);
    }

    /**
     * Search for disputes.
     *
     * @param  string $query
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseSearch
     */
    public static function search($query = '', $publickey = null, $secretkey = null)
    {
        return OmiseSearch::scope('dispute', $publickey, $secretkey)->query($query);
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_reload()
     */
    public function reload()
    {
        if ($this['object'] === 'dispute') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
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
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_update()
     */
    public function accept()
    {
        parent::g_update(self::getUrl($this['id']) . '/accept');
    }

    /**
     * Generate request url.
     *
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }
}
