<?php

namespace Omise\Tests;

require_once dirname(__FILE__).'/../../vendor/autoload.php';

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

class CustomerTest extends \PHPUnit_Framework_TestCase {
  static $_customer;
  
  /**
   * テストケースに使うCustomerを生成
   * ただし、createのテストは別途行う
   */
  public static function setUpBeforeClass() {
   $token = \Omise\Token::create(
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
   
    self::$_customer = \Omise\Customer::create(array(
      'email' => 'john.doe@example.com',
      'description' => 'John Doe (id: 30)',
      'card' => $token['id']
    ));
  }

  public function setUp() {
    /** Do Nothing **/
  }

  /**
   * ----- list allのテスト -----
   * retrieve()に成功し、objectの値がlistであれば正しいとみなす
   */
  public function testListAll() {
    $customer = \Omise\Customer::retrieve();

    $this->assertArrayHasKey('object', $customer);
    $this->assertEquals('list', $customer['object']);
  }

  /**
   * ----- createのテスト -----
   * createに成功し、createで渡したパラメータの値になっていれば正しいとみなす
   */
  public function testCreate() {
    $email = 'john.doe@example.com';
    $description = 'John Doe (id: 30)';
    $token = \Omise\Token::create(
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

    $customer = \Omise\Customer::create(array(
      'email' => $email,
      'description' => $description,
      'card' => $token['id']
    ));

    $this->assertEquals($email, $customer['email']);
    $this->assertEquals($description, $customer['description']);
    
    $customer->destroy();
  }

  /**
   * ----- ritrieveのテスト -----
   * ritrieve(customerID)に成功し、objectの値がcustomerであれば正しいとみなす
   */
  public function testRetrieve() {
  	$customer = \Omise\Customer::retrieve(self::$_customer['id']);

  	$this->assertArrayHasKey('object', $customer);
  	$this->assertEquals('customer', $customer['object']);
  }

  /**
   * ----- updateのテスト -----
   * updateに成功し、update後の値が反映されていれば正しいとみなす
   */
  public function testUpdate() {
    $email = 'john.smith@example.com';
    $description = 'Another description';
    
    $customer = \Omise\Customer::retrieve(self::$_customer['id']);
    $customer->update(array(
      'email' => 'john.smith@example.com',
      'description' => 'Another description'
    ));
    
    $this->assertEquals($email, $customer['email']);
    $this->assertEquals($description, $customer['description']);
  }

  /**
   * ----- destroyのテスト -----
   * destroyに成功し、destroyedのフラグが立っていれば正しいとみなす
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
