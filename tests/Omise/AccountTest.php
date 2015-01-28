<?php

namespace Omise\Tests;

require_once dirname(__FILE__).'/../../vendor/autoload.php';

define('OMISE_PUBLIC_KEY', 'pkey_test_4y9cewl0s1osh44ouud');
define('OMISE_SECRET_KEY', 'skey_test_4y9cewl0rgwji2kbbcb');
class OmiseAccountTest extends \PHPUnit_Framework_TestCase {
  public static function setUpBeforeClass() {
    /** Do Nothing **/
  }
  
  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * ----- reloadのテスト -----
   * reloadに成功し、objectの値がaccountであれば正しいとみなす
   */
  public function testReload() {
    $account = \Omise\Account::retrieve();
    $account->reload();
    
    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
  }

  /**
   * ----- retrieveのテスト -----
   * retrieveに成功し、objectの値がaccountであれば正しいとみなす
   */
  public function testRetrieve() {
    $account = \Omise\Account::retrieve();
    
    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
  }

  /**
   * ----- シングルトンになっているかのテスト -----
   * retrieveを2度実行した結果のインスタンスが同一であれば正しいとみなす
   */
  public function testSameInstance() {
    $account1 = \Omise\Account::retrieve();
    $account2 = \Omise\Account::retrieve();
    
    $this->assertTrue($account1 === $account2);
  }
  
  public function tearDown() {
    /** Do Nothing **/
  }
  
  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
