<?php require_once dirname(__FILE__).'/TestConfig.php';

class TokenTest extends TestConfig {
  /**
   * OmiseToken should contain some method like below.
   *
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseToken', 'retrieve'));
    $this->assertTrue(method_exists('OmiseToken', 'create'));
    $this->assertTrue(method_exists('OmiseToken', 'reload'));
    $this->assertTrue(method_exists('OmiseToken', 'getUrl'));
  }

  /**
   * Assert that a token is successfully created with the given parameters set.
   *
   */
  public function testCreate() {
    $token = OmiseToken::create(array(
      'card' => array('name'              => 'Somchai Prasert',
                      'number'            => '4242424242424242',
                      'expiration_month'  => 10,
                      'expiration_year'   => 2018,
                      'city'              => 'Bangkok',
                      'postal_code'       => '10320',
                      'security_code'     => 123)));

    $this->assertArrayHasKey('object', $token);
    $this->assertEquals('token', $token['object']);
  }

  /**
   * Assert that a customer object is returned after a successful retrieve.
   *
   */
  public function testRetrieve() {
    $token = OmiseToken::retrieve('tokn_test_4zmrjhuk2rndz24a6x0');

    $this->assertArrayHasKey('object', $token);
    $this->assertEquals('token', $token['object']);
  }
}
