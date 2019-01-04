<?php
namespace Omise\Res;

use Omise\ApiRequestor;
use Omise\Res\Obj\OmiseObject;

class OmiseApiResource extends OmiseObject
{
    public $apiRequestor;

    /**
     * @param string $publickey
     * @param string $secretkey
     */
    protected function __construct($publickey = null, $secretkey = null)
    {
        parent::__construct($publickey, $secretkey);
        $this->apiRequestor = new ApiRequestor;
    }

    /**
     * Returns an instance of the class given in $clazz or raise an error.
     *
     * @param  string $clazz
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @throws Exception
     *
     * @return OmiseResource
     */
    protected static function getInstance($clazz, $publickey = null, $secretkey = null)
    {
        if (class_exists($clazz)) {
            return new $clazz($publickey, $secretkey);
        }

        throw new Exception('Undefined class.');
    }

    /**
     * Retrieves the resource.
     *
     * @param  string $clazz
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @throws Exception|OmiseException
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    protected static function g_retrieve($clazz, $url, $publickey = null, $secretkey = null)
    {
        $resource = call_user_func(array($clazz, 'getInstance'), $clazz, $publickey, $secretkey);
        $result   = $resource->apiRequestor->get($url, $resource->getResourceKey());
        $resource->refresh($result);

        return $resource;
    }

    /**
     * Creates the resource with given parameters.in an associative array.
     *
     * @param  string $clazz
     * @param  string $url
     * @param  array  $params
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @throws Exception|OmiseException
     *
     * @return OmiseAccount|OmiseBalance|OmiseCharge|OmiseCustomer|OmiseToken|OmiseTransaction|OmiseTransfer
     */
    protected static function g_create($clazz, $url, $params, $publickey = null, $secretkey = null)
    {
        $resource = call_user_func(array($clazz, 'getInstance'), $clazz, $publickey, $secretkey);
        $result   = $resource->apiRequestor->post($url, $resource->getResourceKey(), $params);
        $resource->refresh($result);

        return $resource;
    }

    /**
     * Updates the resource with the given parameters in an associative array.
     *
     * @param  string $url
     * @param  array  $params
     *
     * @throws Exception|OmiseException
     */
    protected function g_update($url, $params)
    {
        $result = $this->apiRequestor->patch($url, $this->getResourceKey(), $params);
        $this->refresh($result);
    }

    /**
     * Destroys the resource.
     *
     * @param  string $url
     *
     * @throws Exception|OmiseException
     *
     * @return OmiseApiResource
     */
    protected function g_destroy($url)
    {
        $result = $this->apiRequestor->delete($url, $this->getResourceKey());
        $this->refresh($result, true);
    }

    /**
     * Reloads the resource with latest data.
     *
     * @param  string $url
     *
     * @throws Exception|OmiseException
     */
    protected function g_reload($url)
    {
        $result = $this->apiRequestor->get($url, $this->getResourceKey());
        $this->refresh($result);
    }

    /**
     * Checks whether the resource has been destroyed.
     *
     * @return bool|null
     */
    protected function isDestroyed()
    {
        return $this['deleted'];
    }

    /**
     * Returns the secret key.
     *
     * @return string
     */
    protected function getResourceKey()
    {
        return $this->_secretkey;
    }
}
