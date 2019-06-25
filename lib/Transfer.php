<?php
namespace Omise;

use Omise\ApiResource;
use Omise\ScheduleList;
use Omise\Scheduler;
use Omise\Search;

class Transfer extends ApiResource
{
    const ENDPOINT = 'transfers';

    /**
     * Retrieves a transfer.
     *
     * @param  string $id
     *
     * @return Omise\Transfer
     */
    public static function retrieve($id = '')
    {
        return parent::resourceRetrieve($id);
    }

    /**
     * Search for transfers.
     *
     * @param  string $query
     *
     * @return OmiseSearch
     */
    public static function search($query = '')
    {
        return Search::scope('transfer')->query($query);
    }

    /**
     * Schedule a transfer.
     *
     * @param  string $params
     *
     * @return OmiseScheduler
     */
    public static function schedule($params)
    {
        return new Scheduler('transfer', $params);
    }

    /**
     * Creates a transfer.
     *
     * @param  array $params
     *
     * @return Omise\Transfer
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
     * Updates the transfer amount.
     */
    public function save()
    {
        $this->update(array('amount' => $this['amount']));
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_update()
     */
    public function update($params)
    {
        parent::resourceUpdate($params);
    }

    /**
     * Gets a list of transfer schedules.
     *
     * @param  array|string $options
     *
     * @return OmiseScheduleList
     */
    public static function schedules($options = array())
    {
        if (is_array($options)) {
            $options = '?' . http_build_query($options);
        }

        return parent::g_retrieve('\Omise\ScheduleList', self::getUrl('schedules' . $options));
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_destroy()
     */
    public function destroy()
    {
        parent::g_destroy(self::getUrl($this['id']));
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
