<?php
namespace Omise;

use Omise\Res\OmiseApiResource;
use Omise\Search;

class Dispute extends OmiseApiResource
{
    const ENDPOINT = 'disputes';

    /**
     * Retrieves a dispute.
     *
     * @param  string $id
     *
     * @return OmiseDispute
     */
    public static function retrieve($id = '')
    {
        return parent::g_retrieve(get_class(), self::getUrl($id));
    }

    /**
     * Search for disputes.
     *
     * @param  string $query
     *
     * @return OmiseSearch
     */
    public static function search($query = '')
    {
        return Search::scope('dispute')->query($query);
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
     * Generate request url.
     *
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return \Omise\ApiRequestor::OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }
}
