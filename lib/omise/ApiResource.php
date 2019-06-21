<?php
namespace Omise;

use Omise\Omise;
use Omise\ApiRequestor;
use Omise\Resource;

/**
 * @method public static resourceRetrieve
 * @method public static resourceCreate
 * @method public resourceUpdate
 * @method public resourceReload
 * @method public resourceDestroy
 * @method public setId
 * @method public request
 * @method protected url
 * @method protected credential
 *
 * @since 3.0.0
 */
class ApiResource extends \Omise\OmiseObject
{
    /**
     * @param  string $id
     *
     * @return Omise\OmiseObject
     *
     * @throws Omise\Exception
     */
    public static function resourceRetrieve($id = null)
    {
        $resource = Resource::newObject(static::OBJECT_NAME);
        $resource->setId($id);

        $result = $resource->request()->get($resource->url(), $resource->credential());

        $resource->refresh($result);
        return $resource;
    }

    /**
     * @param  array $params
     *
     * @return Omise\OmiseObject
     *
     * @throws Omise\Exception
     */
    public static function resourceCreate($params)
    {
        $resource = Resource::newObject(static::OBJECT_NAME);

        $result = $resource->request()->post($resource->url(), $resource->credential(), $params);

        $resource->setId($result['id']);
        $resource->refresh($result);
        return $resource;
    }

    /**
     * @param  array $params
     *
     * @return Omise\OmiseObject
     *
     * @throws Omise\Exception
     */
    public function resourceUpdate($params)
    {
        $result = $this->request()->patch($this->url(), $this->credential(), $params);
        $this->refresh($result);
    }

    /**
     * @throws Omise\Exception
     */
    public function resourceReload()
    {
        $result = $this->request()->get($this->url(), $this->credential());
        $this->refresh($result);
    }

    /**
     * @throws Omise\Exception
     */
    public function resourceDestroy()
    {
        $result = $this->request()->delete($this->url(), $this->credential());
        $this->refresh($result);
    }

    /**
     * @return \Omise\ApiRequestor  An instance.
     */
    public function request()
    {
        return new ApiRequestor;
    }

    public function chainRequest($method, $endpoint, $params = array())
    {
        return $this->request()->$method($this->url() . '/' . $endpoint, $this->credential(), $params);
    }

    /**
     * @return string
     */
    protected function url()
    {
        return ApiRequestor::OMISE_API_URL . Resource::getEndpoint(static::OBJECT_NAME) . '/' . $this->id;
    }

    /**
     * @return string
     */
    protected function credential()
    {
        return Omise::secretKey();
    }
}
