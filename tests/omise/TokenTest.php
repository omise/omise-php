<?php

require_once dirname(__FILE__).'/TestConfig.php';
if(version_compare(phpversion(), '5.3.2') >= 0 && file_exists(dirname(__FILE__).'/../../vendor/autoload.php')) {
  require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../lib/Omise.php';
}

class TokenTest extends PHPUnit_Framework_TestCase {
  public static function setUpBeforeClass() {
    /** Do Nothing **/
  }

  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * ----- Test create -----
   * Assert that a token is successfully created with the given parameters set.
   */
  public function testCreate() {
    $name = 'Somchai Prasert';
    $expiration_month = 10;
    $expiration_year = 2018;
    $city = 'Bangkok';
    $postal_code = '10320';

    $token = OmiseToken::create(
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
   * ----- Test retrieve -----
   * Assert that a customer object is returned after a successful retrieve.
   */
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
