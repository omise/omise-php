<?php

namespace Omise\OmisePHP\Tests;

use Omise\OmisePHP\OmiseAccount;

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

class OmiseAccountTest extends \PHPUnit_Framework_TestCase {
  public static function setUpBeforeClass() {
    /** Do Nothing **/
  }
  
  public function setUp() {
    /** Do Nothing **/
  }
  
  public function testReload() {
    $account = OmiseAccount::retrieve();
    $account->reload();

    // objectを持っており、そのオブジェクトの実態がaccountである
    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
  }
  
  public function testRetrieve() {
    $account = OmiseAccount::retrieve();
    
    // objectを持っており、そのオブジェクトの実態がaccountである
    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
  }
  
  public function testSameInstance() {
    $account1 = OmiseAccount::retrieve();
    $account2 = OmiseAccount::retrieve();
    
    // シングルトンになっている
    $this->assertTrue($account1 === $account2);
  }
  
  public function tearDown() {
    /** Do Nothing **/
  }
  
  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
