<?php
namespace Omise;

use Omise\ApiRequestor;
use Omise\Omise;
use Omise\Resource;

class Token extends \Omise\ApiResource
{
    const OBJECT_NAME = 'token';

    /**
     * Retrieves a token object.
     *
     * @param  string $id
     *
     * @return Omise\Token
     */
    public static function retrieve($id)
    {
        return parent::resourceRetrieve($id);
    }

    /**
     * Creates a new token.
     * PLEASE NOTE THAT THIS METHOD SHOULD BE USED ONLY
     * IN DEVELOPMENT. IN PRODUCTION, PLEASE USE OMISE.JS!
     *
     * @param  array $params
     *
     * @return Omise\Token
     */
    public static function create($params)
    {
        return parent::resourceCreate($params);
    }

    /**
     * @see Omise\ApiResource::resourceReload()
     */
    public function reload()
    {
        parent::resourceReload();
    }

    /**
     * @return string
     */
    protected function url()
    {
        return ApiRequestor::OMISE_VAULT_URL . Resource::getEndpoint(static::OBJECT_NAME) . '/' . $this->id;
    }

    /**
     * @return string
     */
    protected function credential()
    {
        return Omise::publicKey();
    }
}
