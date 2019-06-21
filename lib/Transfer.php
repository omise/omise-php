<?php
namespace Omise;

use Omise\Res\OmiseApiResource;
use Omise\ScheduleList;
use Omise\Scheduler;
use Omise\Search;

class Transfer extends OmiseApiResource
{
    const ENDPOINT = 'transfers';

    /**
     * Retrieves a transfer.
     *
     * @param  string $id
     *
     * @return OmiseTransfer
     */
    public static function retrieve($id = '')
    {
        return parent::g_retrieve(get_class(), self::getUrl($id));
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
     * @param  mixed  $params
     *
     * @return OmiseTransfer
     */
    public static function create($params)
    {
        return parent::g_create(get_class(), self::getUrl(), $params);
    }

    /**
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_reload()
     */
    public function reload()
    {
        if ($this['object'] === 'transfers') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
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
    protected function update($params)
    {
        parent::g_update(self::getUrl($this['id']), $params);
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
