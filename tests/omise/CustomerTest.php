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
    // Skip a tokenize card and create customer service process
    // and mock it up with static data.
    self::$_customer = array(
      'object'        => 'customer',
      'id'            => 'cust_test_4zmrjg2hct06ybwobqc',
      'livemode'      => false,
      'location'      => '/customers/cust_test_4zmrjg2hct06ybwobqc',
      'default_card'  => 'card_test_4zmrjfzf0spz3mh63cs',
      'email'         => 'john.doe@example.com',
      'description'   => 'John Doe (id: 30)',
      'created'       => '2015-04-08T10:53:33Z',
      'cards'         => array( 'object'  => 'list',
                                'from'    => '1970-01-01T00:00:00+00:00',
                                'to'      => '2015-04-08T10:53:33+00:00',
                                'offset'  => '0',
                                'limit'   => '20',
                                'total'   => '1',
                                'data'    => array(array( 'object'              => 'card',
                                                          'id'                  => 'card_test_4zmrjfzf0spz3mh63cs',
                                                          'livemode'            => '',
                                                          'location'            => '/customers/cust_test_4zmrjg2hct06ybwobqc/cards/card_test_4zmrjfzf0spz3mh63cs',
                                                          'country'             => 'us',
                                                          'city'                => 'Bangkok',
                                                          'postal_code'         => '10320',
                                                          'financing'           => '',
                                                          'last_digits'         => '4242',
                                                          'brand'               => 'Visa',
                                                          'expiration_month'    => '10',
                                                          'expiration_year'     => '2018',
                                                          'fingerprint'         => 'pvtmjojEaHi3y880wV/485z1dVNhASL4xCrxSlsCLBw=',
                                                          'name'                => 'Somchai Prasert',
                                                          'security_code_check' => '1',
                                                          'created'             => '2015-04-08T10:53:33Z')),
                                'location' => '/customers/cust_test_4zmrjg2hct06ybwobqc/cards'));
  }

  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * Assert that a list of customer object could be successfully retrieved.
   */
  public function testRetrieveCustomerListObject() {
    $customer = OmiseCustomer::retrieve();

    $this->assertArrayHasKey('object', $customer);
    $this->assertEquals('list', $customer['object']);
  }

  /**
   * Assert that a customer is successfully created with the given parameters set.
   */
  public function testCreate() {
    $customer = OmiseCustomer::create(array('email'       => 'john.doe@example.com',
                                            'description' => 'John Doe (id: 30)',
                                            'card'        => 'tokn_test_4zmrjhuk2rndz24a6x0'));

    $this->assertArrayHasKey('object', $customer);
    $this->assertEquals('customer', $customer['object']);
  }

  /**
   * Assert that a customer object is returned after a successful retrieve.
   */
  public function testRetrieveSpecificCustomerObjectFromCustomerId() {
    $customer = OmiseCustomer::retrieve(self::$_customer['id']);

    $this->assertArrayHasKey('object', $customer);
    $this->assertEquals('customer', $customer['object']);
  }

  /**
   * Assert that a customer is successfully updated with the given parameters set.
   */
  public function testUpdate() {
    $customer = OmiseCustomer::retrieve(self::$_customer['id']);
    $customer->update(array('email'       => 'john.smith@example.com',
                            'description' => 'Another description'));
    
    $this->assertArrayHasKey('object', $customer);
    $this->assertEquals('customer', $customer['object']);
  }

  /**
   * Assert that a destroyed flag is set after a customer is successfully destroyed.
   */
  public function testDestroy() {
    $customer = OmiseCustomer::retrieve(self::$_customer['id']);
    $customer->destroy();

    $this->assertTrue($customer->isDestroyed());
  }

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
