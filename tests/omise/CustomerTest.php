<?php

require_once dirname(__FILE__).'/TestConfig.php';
if(version_compare(phpversion(), '5.3.2') >= 0 && file_exists(dirname(__FILE__).'/../../vendor/autoload.php')) {
  require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../lib/Omise.php';
}

class CustomerTest extends PHPUnit_Framework_TestCase {
  static $_customer;

  /**
   * Setup the customer to be used in test cases (except in create).
   */
  public static function setUpBeforeClass() {
   $token = OmiseToken::create(
      array('card' => array(
        'name' => 'Somchai Prasert',
        'number' => '4111111111111111',
        'expiration_month' => 10,
        'expiration_year' => 2018,
        'city' => 'Bangkok',
        'postal_code' => '10320',
        'security_code' => 123
      ))
    );

    self::$_customer = OmiseCustomer::create(array(
      'email' => 'john.doe@example.com',
      'description' => 'John Doe (id: 30)',
      'card' => $token['id']
    ));
  }

  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * ----- Test list all -----
   * Assert that a list of customer object could be successfully retrieved.
   */
  public function testListAll() {
    $customer = OmiseCustomer::retrieve();

    $this->assertArrayHasKey('object', $customer);
    $this->assertEquals('list', $customer['object']);
  }

  /**
   * ----- Test create -----
   * Assert that a customer is successfully created with the given parameters set.
   */
  public function testCreate() {
    $email = 'john.doe@example.com';
    $description = 'John Doe (id: 30)';
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

    $customer = OmiseCustomer::create(array(
      'email' => $email,
      'description' => $description,
      'card' => $token['id']
    ));

    $this->assertEquals($email, $customer['email']);
    $this->assertEquals($description, $customer['description']);

    $customer->destroy();
  }

  /**
   * ----- Test retrieve -----
   * Assert that a customer object is returned after a successful retrieve.
   */
  public function testRetrieve() {
  	$customer = OmiseCustomer::retrieve(self::$_customer['id']);

  	$this->assertArrayHasKey('object', $customer);
  	$this->assertEquals('customer', $customer['object']);
  }

  /**
   * ----- Test update -----
   * Assert that a customer is successfully updated with the given parameters set.
   */
  public function testUpdate() {
    $email = 'john.smith@example.com';
    $description = 'Another description';

    $customer = OmiseCustomer::retrieve(self::$_customer['id']);
    $customer->update(array(
      'email' => 'john.smith@example.com',
      'description' => 'Another description'
    ));

    $this->assertEquals($email, $customer['email']);
    $this->assertEquals($description, $customer['description']);
  }

  /**
   * ----- Test destroy -----
   * Assert that a destroyed flag is set after a customer is successfully destroyed.
   */
  public function testDestroy() {
  	self::$_customer->destroy();

  	$this->assertTrue(self::$_customer->isDestroyed());
  	self::$_customer = null;
  }

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    if(self::$_customer != null) {
    	self::$_customer->destroy();
    }
  }
}
