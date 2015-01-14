<?php

require_once 'PHPUnit/Autoload.php';
require_once dirname(__FILE__).'/../lib/Omise.php';

class OmiseAccountTest extends PHPUnit_Framework_TestCase {
  public function setUpBeforeClass() {
    /** Do Nothing **/
  }
  
  public function setUp() {
    /** Do Nothing **/
  }
  
  public function testReload() {
    $account = OmiseAccount::retrieve();
    $account->reload();
    
    // リロード前のオブジェクトとリロード後のオブジェクトが一致する（singletonのため）
    $this->assertInternalType('OmiseAccount', $account);
    $this->assertArrayHasKey('object', $account);
    $this->assertEquals('account', $account['object']);
  }
  
  public function testRetrieve() {
    $account = OmiseAccount::retrieve();
    
    // 型が同一、objectを持っており、そのオブジェクトの実態がaccountである
    $this->assertInternalType('OmiseAccount', $account);
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
  
  public function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
