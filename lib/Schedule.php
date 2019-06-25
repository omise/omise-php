<?php
namespace Omise;

use Omise\Res\OmiseApiResource;
use Omise\OccurrenceList;

class Schedule extends OmiseApiResource
{
    const ENDPOINT = 'schedules';

    /**
     * Retrieves a schedule.
     *
     * @param  string $id
     *
     * @return OmiseSchedule
     */
    public static function retrieve($id = '')
    {
        return parent::g_retrieve(get_class(), self::getUrl($id));
    }

    /**
     * @return void
     */
    public function reload()
    {
        if ($this['object'] === 'schedule') {
            parent::g_reload(self::getUrl($this['id']));
        } else {
            parent::g_reload(self::getUrl());
        }
    }

    /**
     * Creates a new schedule.
     *
     * @param  array  $params
     *
     * @return OmiseSchedule
     */
    public static function create($params)
    {
        return parent::g_create(get_class(), self::getUrl(), $params);
    }

    /**
     * @param  array|string $options
     *
     * @return OmiseOccurrenceList|null
     */
    public function occurrences($options = array())
    {
        if ($this['object'] === 'schedule') {
            if (is_array($options)) {
                $options = '?' . http_build_query($options);
            }

            return parent::g_retrieve('\Omise\OccurrenceList', self::getUrl($this['id'] . '/occurrences' . $options));
        }
    }

    /**
     * @return void
     */
    public function destroy()
    {
        parent::g_destroy(self::getUrl($this['id']));
    }

    /**
     * @return bool
     *
     * @see    OmiseApiResource::isDestroyed()
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
        return \Omise\ApiRequestor::OMISE_API_URL.self::ENDPOINT . '/' . $id;
    }
}
