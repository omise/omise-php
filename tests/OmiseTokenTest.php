<?php

require_once 'PHPUnit.phar';
require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/../lib/Omise.php';

class OmiseTokenTest extends PHPUnit_Framework_TestCase {
  public static function setUpBeforeClass() {
    /** Do Nothing **/
  }
  
  public function setUp() {
    /** Do Nothing **/
  }
  
  public function testCreate() {
    $token = OmiseToken::create(
      array('card' => array(
        'name' => 'Somchai Prasert',
        'number' => '4242424242424242',
        'expiration_month' => 10,
        'expiration_year' => 2018,
        'city' => 'Bangkok',
        'postal_code' => '10320',
        'security_code' => 123
     ))
    );

    // objectを持っており、そのオブジェクトの実態がtokenである
    $this->assertArrayHasKey('object', $token);
    $this->assertEquals('token', $token['object']);
  }
  
  public function testRetrieve() {
    $token1 = OmiseToken::create(
      array('card' => array(
        'name' => 'Somchai Prasert',
        'number' => '4242424242424242',
        'expiration_month' => 10,
        'expiration_year' => 2018,
        'city' => 'Bangkok',
        'postal_code' => '10320',
        'security_code' => 123
     ))
    );
    
    $token2 = OmiseToken::retrieve($token1['id']);

    // retrieveした結果が正しい
    $this->assertEquals($token1['id'], $token2['id']);
  }
  
  public function tearDown() {
    /** Do Nothing **/
  }
  
  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
