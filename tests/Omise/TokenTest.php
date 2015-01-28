<?php

namespace Omise\Tests;

require_once dirname(__FILE__).'/../../vendor/autoload.php';

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

class TokenTest extends \PHPUnit_Framework_TestCase {
  public static function setUpBeforeClass() {
    /** Do Nothing **/
  }
  
  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * ----- createのテスト -----
   * createに成功し、createで渡したパラメータの値になっていれば正しいとみなす
   */
  public function testCreate() {
    $name = 'Somchai Prasert';
    $expiration_month = 10;
    $expiration_year = 2018;
    $city = 'Bangkok';
    $postal_code = '10320';
    
    $token = \Omise\Token::create(
      array('card' => array(
        'name' => $name,
        'number' => '4242424242424242',
        'expiration_month' => $expiration_month,
        'expiration_year' => $expiration_year,
        'city' => $city,
        'postal_code' => $postal_code,
        'security_code' => 123
     ))
    );

    $this->assertEquals($name, $token['card']['name']);
    $this->assertEquals($expiration_month, $token['card']['expiration_month']);
    $this->assertEquals($expiration_year, $token['card']['expiration_year']);
    $this->assertEquals($city, $token['card']['city']);
    $this->assertEquals($postal_code, $token['card']['postal_code']);
  }
  
  /**
   * ----- ritrieveのテスト -----
   * ritrieveに成功し、objectの値がtokenであれば正しいとみなす
   */
  public function testRetrieve() {
    $token1 = \Omise\Token::create(
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
    
    $token2 = \Omise\Token::retrieve($token1['id']);

  	$this->assertArrayHasKey('object', $token2);
  	$this->assertEquals('token', $token2['object']);
  }
  
  public function tearDown() {
    /** Do Nothing **/
  }
  
  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
