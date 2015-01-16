<?php

require_once 'PHPUnit.phar';
require_once dirname(__FILE__).'/../lib/Omise.php';

class OmiseBalanceTest extends PHPUnit_Framework_TestCase {
  public static function setUpBeforeClass() {
    /** Do Nothing **/
  }
  
  public function setUp() {
    /** Do Nothing **/
  }
  
  public function testReload() {
    $balance = OmiseBalance::retrieve();
    $balance->reload();

    // objectを持っており、そのオブジェクトの実態がaccountである
    $this->assertArrayHasKey('object', $balance);
    $this->assertEquals('balance', $balance['object']);
  }
  
  public function testRetrieve() {
    $balance = OmiseBalance::retrieve();
    
    // objectを持っており、そのオブジェクトの実態がaccountである
    $this->assertArrayHasKey('object', $balance);
    $this->assertEquals('balance', $balance['object']);
  }
  
  public function testSameInstance() {
    $balance1 = OmiseBalance::retrieve();
    $balance2 = OmiseBalance::retrieve();
    
    // シングルトンになっている
    $this->assertTrue($balance1 === $balance2);
  }
  
  public function tearDown() {
    /** Do Nothing **/
  }
  
  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
