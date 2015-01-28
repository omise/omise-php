<?php

namespace Omise\OmisePHP\Tests;

use Omise\OmisePHP;

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

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
    $account = OmisePHP\Account::retrieve();
    $account->reload();
    
    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
  }

  /**
   * ----- retrieveのテスト -----
   * retrieveに成功し、objectの値がaccountであれば正しいとみなす
   */
  public function testRetrieve() {
    $account = OmisePHP\Account::retrieve();
    
    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
  }

  /**
   * ----- シングルトンになっているかのテスト -----
   * retrieveを2度実行した結果のインスタンスが同一であれば正しいとみなす
   */
  public function testSameInstance() {
    $account1 = OmisePHP\Account::retrieve();
    $account2 = OmisePHP\Account::retrieve();
    
    $this->assertTrue($account1 === $account2);
  }
  
  public function tearDown() {
    /** Do Nothing **/
  }
  
  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
