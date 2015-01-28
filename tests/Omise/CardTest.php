<?php

namespace Omise\Tests;

use Omise;


define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');
define('OMISE_PUBLIC_KEY', 'pkey_test_4y9cewl0s1osh44ouud');
define('OMISE_SECRET_KEY', 'skey_test_4y9cewl0rgwji2kbbcb');

class CardTest extends \PHPUnit_Framework_TestCase {
  static $customer;
  
  /**
   * テストケースに使うCustomerとCardを作成する
   */
  public static function setUpBeforeClass() {
    $token = OmisePHP\Token::create(
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
    
    self::$customer = OmisePHP\Customer::create(array(
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
   * retrieve(customerId)に成功し、objectの値がcustomerであれば正しいとみなす
   */
  public function testListAll() {
    $customer = OmiseCustomer::retrieve(OmiseCardTest::$customerID);
    
    // objectを持っており、そのオブジェクトの実態がlistである
    $this->assertArrayHasKey('object', $customer);
    $this->assertEquals('customer', $customer['object']);
  }

  /**
   * ----- ritrieveのテスト -----
   * retrieve(customerId)に成功し、objectの値がcustomerであれば正しいとみなす
   */
  public function testRetrieve() {
    $customer = OmiseCustomer::retrieve(OmiseCardTest::$customerID);
    $card = $customer->getCards()->retrieve(OmiseCardTest::$cardID);

    // objectを持っており、そのオブジェクトの実態がcardである
    $this->assertArrayHasKey('object', $card);
    $this->assertEquals('card', $card['object']);
  }

  public function testReload() {
    $customer = OmiseCustomer::retrieve(OmiseCardTest::$customerID);
    $card = $customer->getCards()->retrieve(OmiseCardTest::$cardID);
    $card->reload();
  
    // objectを持っており、そのオブジェクトの実態がcardである
    $this->assertArrayHasKey('object', $card);
    $this->assertEquals('card', $card['object']);
  }

  public function testUpdate() {
    $month = 11;
    $year = 2017;
    $name = 'Somchai Praset';
    $postalcode = '10310';
    
    $customer = OmiseCustomer::retrieve(OmiseCardTest::$customerID);
    $card = $customer->getCards()->retrieve(OmiseCardTest::$cardID);
    $card->update(array(
      'expiration_month' => $month,
      'expiration_year' => $year,
      'name' => $name,
      'postal_code' => $postalcode
    ));

    // updateした値になっている
    $this->assertEquals($month, $card['expiration_month']);
    $this->assertEquals($year, $card['expiration_year']);
    $this->assertEquals($name, $card['name']);
    $this->assertEquals($postalcode, $card['postal_code']);
  }
  
  /*
   * destroyのテストを有効にする場合コメント解除
  public function testDestroy() {
    $customer = OmiseCustomer::retrieve(OmiseCardTest::$customerID);
    $card = $customer->getCards()->retrieve(OmiseCardTest::$cardID);
    $card->destroy();

    // 削除されている
    $this->assertTrue($card->isDestroyed());
  }
  */

  public function tearDown() {
    /** Do Nothing **/
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
