<?php

if(version_compare(phpversion(), '5.3.2') >= 0) {
  require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../lib/Omise.php';
}

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

class OmiseAccountTest extends PHPUnit_Framework_TestCase {
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
    $account = OmiseAccount::retrieve();
    $account->reload();
    
    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
  }

  /**
   * ----- retrieveのテスト -----
   * retrieveに成功し、objectの値がaccountであれば正しいとみなす
   */
  public function testRetrieve() {
    $account = OmiseAccount::retrieve();
    
    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
  }

  /**
   * ----- シングルトンになっているかのテスト -----
   * retrieveを2度実行した結果のインスタンスが同一であれば正しいとみなす
   */
  public function testSameInstance() {
    $account1 = OmiseAccount::retrieve();
    $account2 = OmiseAccount::retrieve();
    
    $this->assertTrue($account1 === $account2);
  }
  
  public function tearDown() {
    /** Do Nothing **/
  }
  
  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
