<?php
namespace Omise;

use Omise\Res\OmiseApiResource;
use Omise\ScheduleList;
use Omise\Search;

class Recipient extends OmiseApiResource
{
    const ENDPOINT = 'recipients';

    /**
     * Retrieves recipients.
     *
     * @param  string $id
     *
     * @return OmiseRecipient
     */
    public static function retrieve($id = '')
    {
        return parent::g_retrieve(get_class(), self::getUrl($id));
    }

    /**
     * Search for recipients.
     *
     * @param  string $query
     *
     * @return OmiseSearch
     */
    public static function search($query = '')
    {
        return Search::scope('recipient')->query($query);
    }

    /**
     * Creates a new recipient.
     *
     * @param  array  $params
     *
     * @return OmiseRecipient
     */
    public static function create($params)
    {
        return parent::g_create(get_class(), self::getUrl(), $params);
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
     * (non-PHPdoc)
     *
     * @see OmiseApiResource::g_reload()
     */
    public function reload()
    {
        if ($this['object'] === 'recipient') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
    }

    /**
     * Gets a list of transfer schedules that belongs to a given recipient.
     *
     * @param  array|string $options
     *
     * @return OmiseScheduleList
     */
    public function schedules($options = array())
    {
        if ($this['object'] === 'recipient') {
            if (is_array($options)) {
                $options = '?' . http_build_query($options);
            }

            return parent::g_retrieve('\Omise\ScheduleList', self::getUrl($this['id'] . '/schedules' . $options));
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
