<?php
namespace Omise;

/**
 * @method public static publicKey
 * @method public static secretKey
 * @method public static apiVersion
 * @method public static userAgent
 * @method public static client
 * @method public static setPublicKey
 * @method public static setSecretKey
 * @method public static setApiVersion
 * @method public static setUserAgent
 * @method public static setClient
 *
 * @since 3.0.0
 */
class Omise
{
    const VERSION = '3.0.0-dev';

    /**
     * @var string  Of Omise credentials (public key, secret key).
     */
    protected static $publicKey;
    protected static $secretKey;

    /**
     * @var string  Of Omise API version.
     */
    protected static $apiVersion;

    /**
     * @var string  Of a custom USER-AGENT.
     */
    protected static $userAgent;

    /**
     * @var Omise\Client\ClientInterface
     */
    protected static $client = '\Omise\Client\CurlClient';

    /**
     * @return string
     */
    public static function publicKey()
    {
        // Backward compatible with v2.x and below.
        if (is_null(static::$publicKey) && defined('OMISE_PUBLIC_KEY')) {
            Omise::setPublicKey(OMISE_PUBLIC_KEY);
        }

        return static::$publicKey;
    }

    /**
     * @return string
     */
    public static function secretKey()
    {
        // Backward compatible with v2.x and below.
        if (is_null(static::$secretKey) && defined('OMISE_SECRET_KEY')) {
            Omise::setSecretKey(OMISE_SECRET_KEY);
        }

        return static::$secretKey;
    }

    /**
     * @return string
     */
    public static function apiVersion()
    {
        // Backward compatible with v2.x and below.
        if (is_null(static::$apiVersion) && defined('OMISE_API_VERSION')) {
            Omise::setApiVersion(OMISE_API_VERSION);
        }

        return static::$apiVersion;
    }

    /**
     * @return string
     */
    public static function userAgent()
    {
        // Backward compatible with v2.x and below.
        if (is_null(static::$userAgent) && defined('OMISE_USER_AGENT_SUFFIX')) {
            Omise::setUserAgent(OMISE_USER_AGENT_SUFFIX);
        }

        return static::$userAgent;
    }

    /**
     * @return \Omise\Client\ClientInterface  A new instance of a ClientInterface-implemented object.
     */
    public static function client()
    {
        return new static::$client;
    }

    /**
     * @param string $key
     */
    public static function setPublicKey($key)
    {
        static::$publicKey = $key;
    }

    /**
     * @param string $key
     */
    public static function setSecretKey($key)
    {
        static::$secretKey = $key;
    }

    /**
     * @param string $version  Of a specific Omise API version.
     *                         All available options are as follow:
     *                           • 2014-07-27
     *                           • 2015-11-17
     *                           • 2017-11-02
     *                           • 2019-05-29
     */
    public static function setApiVersion($version)
    {
        static::$apiVersion = $version;
    }

    /**
     * @param string $userAgent
     */
    public static function setUserAgent($userAgent)
    {
        static::$userAgent = $userAgent;
    }

    /**
     * @param string $client  Client class name
     */
    public static function setClient($client)
    {
        static::$client = $client;
    }
}

// Cores and utilities.
require_once __DIR__ . '/omise/Client/ClientInterface.php';
require_once __DIR__ . '/omise/Client/CurlClient.php';
require_once __DIR__ . '/omise/Client/UnitTestClient.php';
require_once __DIR__ . '/omise/Http/Response/Handler.php';
require_once __DIR__ . '/omise/OmiseObject.php';
require_once __DIR__ . '/omise/ApiRequestor.php';
require_once __DIR__ . '/omise/ApiResource.php';
require_once __DIR__ . '/omise/Resource.php';
require_once __DIR__ . '/Collection.php';
// require_once __DIR__ . '/omise/res/obj/OmiseObject.php';
// require_once __DIR__ . '/omise/res/OmiseApiResource.php';
// require_once __DIR__ . '/omise/res/OmiseVaultResource.php';

// Errors
require_once __DIR__ . '/omise/exception/OmiseExceptions.php';

// API Resources.
require_once __DIR__ . '/Account.php';
require_once __DIR__ . '/Balance.php';
require_once __DIR__ . '/Capabilities.php';
// require_once __DIR__ . '/Card.php';
// require_once __DIR__ . '/CardList.php';
require_once __DIR__ . '/Charge.php';
require_once __DIR__ . '/Customer.php';
require_once __DIR__ . '/Dispute.php';
require_once __DIR__ . '/Event.php';
require_once __DIR__ . '/Forex.php';
require_once __DIR__ . '/Link.php';
// require_once __DIR__ . '/Occurrence.php';
// require_once __DIR__ . '/OccurrenceList.php';
// require_once __DIR__ . '/Recipient.php';
require_once __DIR__ . '/Refund.php';
// require_once __DIR__ . '/RefundList.php';
require_once __DIR__ . '/Schedule.php';
// require_once __DIR__ . '/ScheduleList.php';
// require_once __DIR__ . '/Scheduler.php';
require_once __DIR__ . '/Search.php';
require_once __DIR__ . '/Source.php';
require_once __DIR__ . '/Token.php';
require_once __DIR__ . '/Transaction.php';
require_once __DIR__ . '/Transfer.php';

// API Resources - Legacy classes.
require_once __DIR__ . '/omise/OmiseAccount.php';
require_once __DIR__ . '/omise/OmiseBalance.php';
require_once __DIR__ . '/omise/OmiseCapabilities.php';
// require_once __DIR__ . '/omise/OmiseCard.php';
// require_once __DIR__ . '/omise/OmiseCardList.php';
require_once __DIR__ . '/omise/OmiseCharge.php';
require_once __DIR__ . '/omise/OmiseCustomer.php';
require_once __DIR__ . '/omise/OmiseDispute.php';
require_once __DIR__ . '/omise/OmiseEvent.php';
require_once __DIR__ . '/omise/OmiseForex.php';
require_once __DIR__ . '/omise/OmiseLink.php';
// require_once __DIR__ . '/omise/OmiseOccurrence.php';
// require_once __DIR__ . '/omise/OmiseOccurrenceList.php';
// require_once __DIR__ . '/omise/OmiseRecipient.php';
require_once __DIR__ . '/omise/OmiseRefund.php';
// require_once __DIR__ . '/omise/OmiseRefundList.php';
require_once __DIR__ . '/omise/OmiseSchedule.php';
// require_once __DIR__ . '/omise/OmiseScheduleList.php';
// require_once __DIR__ . '/omise/OmiseScheduler.php';
require_once __DIR__ . '/omise/OmiseSearch.php';
require_once __DIR__ . '/omise/OmiseSource.php';
require_once __DIR__ . '/omise/OmiseToken.php';
require_once __DIR__ . '/omise/OmiseTransaction.php';
require_once __DIR__ . '/omise/OmiseTransfer.php';
