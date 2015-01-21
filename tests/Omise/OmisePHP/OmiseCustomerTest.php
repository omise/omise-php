<?php

namespace Omise\OmisePHP\Tests;

require_once 'PHPUnit.phar';
require_once dirname(__FILE__).'/../lib/Omise.php';

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

class OmiseCustomerTest extends PHPUnit_Framework_TestCase {
  static $customerID = 'cust_test_4xtrb759599jsxlhkrb';
  
  public static function setUpBeforeClass() {
  	$customer = OmiseCustomer::retrieve();
  	
    if(count($customer['data']) > 0) {
  	  OmiseCustomerTest::$customerID = $customer['data'][0]['id'];
    }
  }

  public function setUp() {
    /** Do Nothing **/
  }

  public function testListAll() {
    $customer = OmiseCustomer::retrieve();

    // objectを持っており、そのオブジェクトの実態がlistである
    $this->assertArrayHasKey('object', $customer);
    $this->assertEquals('list', $customer['object']);
  }

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

    // createした値になっている
    $this->assertEquals($email, $customer['email']);
    $this->assertEquals($description, $customer['description']);
  }

  public function testRetrieve() {
  	$customer = OmiseCustomer::retrieve(OmiseCustomerTest::$customerID);
  
  	// objectを持っており、そのオブジェクトの実態がcustomerである
  	$this->assertArrayHasKey('object', $customer);
  	$this->assertEquals('customer', $customer['object']);
  }
  
  public function testUpdate() {
    $email = 'john.smith@example.com';
    $description = 'Another description';
    
    $customer = OmiseCustomer::retrieve(OmiseCustomerTest::$customerID);
    $customer->update(array(
      'email' => 'john.smith@example.com',
      'description' => 'Another description'
    ));
    
    // updateした値になっている
    $this->assertEquals($email, $customer['email']);
    $this->assertEquals($description, $customer['description']);
  }
  
  public function testDestroy() {
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
  			'email' => 'john.doe@example.com',
  			'description' => 'John Doe (id: 30)',
  			'card' => $token['id']
  	));
  	
  	$customer->destroy();
  
  	// 削除されている
  	$this->assertTrue($customer->isDestroyed());
  }

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
