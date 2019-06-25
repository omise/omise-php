<?php
namespace Omise;

class Resource
{
    /**
     * @var array  Of known resources.
     */
    protected static $knownResources = array(
        'account'     => array('endpoint' => 'account',      'class' => 'Omise\Account'),
        'balance'     => array('endpoint' => 'balance',      'class' => 'Omise\Balance'),
        'capability'  => array('endpoint' => 'capability',   'class' => 'Omise\Capabilities'),
        'card'        => array('endpoint' => 'cards',        'class' => 'Omise\Card'),
        'charge'      => array('endpoint' => 'charges',      'class' => 'Omise\Charge'),
        'customer'    => array('endpoint' => 'customers',    'class' => 'Omise\Customer'),
        'dispute'     => array('endpoint' => 'disputes',     'class' => 'Omise\Dispute'),
        'event'       => array('endpoint' => 'events',       'class' => 'Omise\Event'),
        'forex'       => array('endpoint' => 'forex',        'class' => 'Omise\Forex'),
        'link'        => array('endpoint' => 'links',        'class' => 'Omise\Link'),
        'occurrence'  => array('endpoint' => 'occurrences',  'class' => 'Omise\Occurrence'),
        'recipient'   => array('endpoint' => 'recipients',   'class' => 'Omise\Recipient'),
        'refund'      => array('endpoint' => 'refunds',      'class' => 'Omise\Refund'),
        'schedule'    => array('endpoint' => 'schedules',    'class' => 'Omise\Schedule'),
        'search'      => array('endpoint' => 'search',       'class' => 'Omise\Search'),
        'source'      => array('endpoint' => 'sources',      'class' => 'Omise\Source'),
        'token'       => array('endpoint' => 'tokens',       'class' => 'Omise\Token'),
        'transaction' => array('endpoint' => 'transactions', 'class' => 'Omise\Transaction'),
        'transfer'    => array('endpoint' => 'transfers',    'class' => 'Omise\Transfer'),
    );

    public static function getEndpoint($object)
    {
        return isset(static::$knownResources[$object]) ? static::$knownResources[$object]['endpoint'] : null;
    }

    public static function getClassName($object)
    {
        return isset(static::$knownResources[$object]) ? static::$knownResources[$object]['class'] : null;
    }

    public static function newObject($object, $value = array())
    {
        $classname = static::getClassName($object);
        return new $classname($value);
    }
}
