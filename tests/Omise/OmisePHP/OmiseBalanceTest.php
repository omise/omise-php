<?php

namespace Omise\OmisePHP\Tests;

require_once 'PHPUnit.phar';
require_once dirname(__FILE__).'/../lib/Omise.php';

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

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

    // objectを持っており、そのオブジェクトの実態がbalanceである
    $this->assertArrayHasKey('object', $balance);
    $this->assertEquals('balance', $balance['object']);
  }
  
  public function testRetrieve() {
    $balance = OmiseBalance::retrieve();
    
    // objectを持っており、そのオブジェクトの実態がbalanceである
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
