<?php
namespace Omise;

/**
 * @method public static publicKey
 * @method public static secretKey
 * @method public static apiVersion
 * @method public static userAgent
 * @method public static setPublicKey
 * @method public static setSecretKey
 * @method public static setApiVersion
 * @method public static setUserAgent
 *
 * @since 3.0.0
 */
class Omise
{
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
}

// Cores and utilities.
require_once dirname(__FILE__).'/omise/ApiRequestor.php';
require_once dirname(__FILE__).'/omise/res/obj/OmiseObject.php';
require_once dirname(__FILE__).'/omise/res/OmiseApiResource.php';
require_once dirname(__FILE__).'/omise/res/OmiseVaultResource.php';
require_once dirname(__FILE__).'/omise/Http/Response/Handler.php';

// Errors
require_once dirname(__FILE__).'/omise/exception/OmiseExceptions.php';

// API Resources.
require_once dirname(__FILE__).'/Account.php';
require_once dirname(__FILE__).'/Balance.php';
require_once dirname(__FILE__).'/Capabilities.php';
require_once dirname(__FILE__).'/Card.php';
require_once dirname(__FILE__).'/CardList.php';
require_once dirname(__FILE__).'/Charge.php';
require_once dirname(__FILE__).'/Customer.php';
require_once dirname(__FILE__).'/Dispute.php';
require_once dirname(__FILE__).'/Event.php';
require_once dirname(__FILE__).'/Forex.php';
require_once dirname(__FILE__).'/Link.php';
require_once dirname(__FILE__).'/Occurrence.php';
require_once dirname(__FILE__).'/OccurrenceList.php';
require_once dirname(__FILE__).'/Recipient.php';
require_once dirname(__FILE__).'/Refund.php';
require_once dirname(__FILE__).'/RefundList.php';
require_once dirname(__FILE__).'/Schedule.php';
require_once dirname(__FILE__).'/ScheduleList.php';
require_once dirname(__FILE__).'/Scheduler.php';
require_once dirname(__FILE__).'/Search.php';
require_once dirname(__FILE__).'/Source.php';
require_once dirname(__FILE__).'/Token.php';
require_once dirname(__FILE__).'/Transaction.php';
require_once dirname(__FILE__).'/Transfer.php';

// API Resources - Legacy classes.
require_once dirname(__FILE__).'/omise/OmiseAccount.php';
require_once dirname(__FILE__).'/omise/OmiseBalance.php';
require_once dirname(__FILE__).'/omise/OmiseCapabilities.php';
require_once dirname(__FILE__).'/omise/OmiseCard.php';
require_once dirname(__FILE__).'/omise/OmiseCardList.php';
require_once dirname(__FILE__).'/omise/OmiseDispute.php';
require_once dirname(__FILE__).'/omise/OmiseEvent.php';
require_once dirname(__FILE__).'/omise/OmiseForex.php';
require_once dirname(__FILE__).'/omise/OmiseToken.php';
require_once dirname(__FILE__).'/omise/OmiseCharge.php';
require_once dirname(__FILE__).'/omise/OmiseCustomer.php';
require_once dirname(__FILE__).'/omise/OmiseOccurrence.php';
require_once dirname(__FILE__).'/omise/OmiseOccurrenceList.php';
require_once dirname(__FILE__).'/omise/OmiseRefund.php';
require_once dirname(__FILE__).'/omise/OmiseRefundList.php';
require_once dirname(__FILE__).'/omise/OmiseSearch.php';
require_once dirname(__FILE__).'/omise/OmiseSchedule.php';
require_once dirname(__FILE__).'/omise/OmiseScheduleList.php';
require_once dirname(__FILE__).'/omise/OmiseScheduler.php';
require_once dirname(__FILE__).'/omise/OmiseSource.php';
require_once dirname(__FILE__).'/omise/OmiseTransfer.php';
require_once dirname(__FILE__).'/omise/OmiseTransaction.php';
require_once dirname(__FILE__).'/omise/OmiseRecipient.php';
require_once dirname(__FILE__).'/omise/OmiseLink.php';
