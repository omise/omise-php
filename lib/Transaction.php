<?php
namespace Omise;

use Omise\Res\OmiseApiResource;

class Transaction extends OmiseApiResource
{
    const ENDPOINT = 'transactions';

    /**
     * Retrieves a transaction.
     *
     * @param  string $id
     *
     * @return OmiseTransaction
     */
    public static function retrieve($id = '')
    {
        return parent::g_retrieve(get_class(), self::getUrl($id));
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_reload()
     */
    public function reload()
    {
        if ($this['object'] === 'transaction') {
            parent::reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
    }

    /**
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return \Omise\ApiRequestor::OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }
}
