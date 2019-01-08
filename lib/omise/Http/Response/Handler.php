<?php
namespace Omise\Http\Response;

class Handler
{
    /**
     * @param mixed $result
     */
    public function handle($result)
    {
        if (! $this->isJson($result)) {
            throw new \Exception('Unknown error. (Bad Response)');
        }

        $result = json_decode($result, true);

        if ($result['object'] === 'error') {
            throw \OmiseException::getInstance($result);
        }

        return $result;
    }

    /**
     * @param  mixed $result
     * @return bool
     */
    public function isJson($result)
    {
        if (is_string($result) && json_decode($result)) {
            return json_last_error() === JSON_ERROR_NONE;
        }

        return false;
    }
}
