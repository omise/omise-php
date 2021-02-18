<?php
if (!defined('OMISE_PUBLIC_KEY')) {
    define('OMISE_PUBLIC_KEY', 'pkey');
}
if (!defined('OMISE_SECRET_KEY')) {
    define('OMISE_SECRET_KEY', 'skey');
}

require_once dirname(__FILE__).'/../../lib/Omise.php';

class ClassExistsTest extends PHPUnit_Framework_TestCase
{
    /**
     * All classes in lib folder should be loaded inside lib/Omise.php.
     */
    public function testAPIClassesExists()
    {
        $this->assertTrue(class_exists('OmiseAccount'));
        $this->assertTrue(class_exists('OmiseBalance'));
        $this->assertTrue(class_exists('OmiseCapabilities'));
        $this->assertTrue(class_exists('OmiseCard'));
        $this->assertTrue(class_exists('OmiseCardList'));
        $this->assertTrue(class_exists('OmiseChain'));
        $this->assertTrue(class_exists('OmiseCharge'));
        $this->assertTrue(class_exists('OmiseCustomer'));
        $this->assertTrue(class_exists('OmiseDispute'));
        $this->assertTrue(class_exists('OmiseEvent'));
        $this->assertTrue(class_exists('OmiseForex'));
        $this->assertTrue(class_exists('OmiseLink'));
        $this->assertTrue(class_exists('OmiseOccurrence'));
        $this->assertTrue(class_exists('OmiseOccurrenceList'));
        $this->assertTrue(class_exists('OmiseReceipt'));
        $this->assertTrue(class_exists('OmiseRecipient'));
        $this->assertTrue(class_exists('OmiseRefund'));
        $this->assertTrue(class_exists('OmiseRefundList'));
        $this->assertTrue(class_exists('OmiseSchedule'));
        $this->assertTrue(class_exists('OmiseScheduleList'));
        $this->assertTrue(class_exists('OmiseScheduler'));
        $this->assertTrue(class_exists('OmiseSource'));
        $this->assertTrue(class_exists('OmiseToken'));
        $this->assertTrue(class_exists('OmiseTransaction'));
        $this->assertTrue(class_exists('OmiseTransfer'));
    }

    /**
     * All resource classes should be loaded.
     */
    public function testResourceClassesExists()
    {
        $this->assertTrue(class_exists('OmiseApiResource'));
        $this->assertTrue(class_exists('OmiseVaultResource'));
        $this->assertTrue(class_exists('OmiseObject'));
        $this->assertTrue(class_exists('OmiseException'));
    }
}
