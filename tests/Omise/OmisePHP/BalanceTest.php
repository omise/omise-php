<?php

namespace Omise\OmisePHP\Tests;

use Omise\OmisePHP;

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

class OmiseBalanceTest extends \PHPUnit_Framework_TestCase {
  public static function setUpBeforeClass() {
    /** Do Nothing **/
  }
  
  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * ----- reloadのテスト -----
   * reloadに成功し、objectの値がbalanceであれば正しいとみなす
   */
  public function testReload() {
    $balance = OmisePHP\Balance::retrieve();
    $balance->reload();

    $this->assertArrayHasKey('object', $balance);
    $this->assertEquals('balance', $balance['object']);
  }

  /**
   * ----- retrieveのテスト -----
   * retrieveに成功し、objectの値がbalanceであれば正しいとみなす
   */
  public function testRetrieve() {
    $balance = OmisePHP\Balance::retrieve();
    
    $this->assertArrayHasKey('object', $balance);
    $this->assertEquals('balance', $balance['object']);
  }

  /**
   * ----- シングルトンになっているかのテスト -----
   * retrieveを2度実行した結果のインスタンスが同一であれば正しいとみなす
   */
  public function testSameInstance() {
    $balance1 = OmisePHP\Balance::retrieve();
    $balance2 = OmisePHP\Balance::retrieve();
    
    $this->assertTrue($balance1 === $balance2);
  }
  
  public function tearDown() {
    /** Do Nothing **/
  }
  
  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
