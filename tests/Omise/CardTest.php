<?php

if(version_compare(phpversion(), '5.3.2') >= 0) {
  require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../lib/Omise.php';
}

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

class CardTest extends PHPUnit_Framework_TestCase {
  private $_customer;
  
  public static function setUpBeforeClass() {
  	/** Do Nothing **/
  }

  /**
   * テストケースに使うCustomerを作成する
   */
  public function setUp() {
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
   
    $this->_customer = OmiseCustomer::create(array(
      'email' => 'john.doe@example.com',
      'description' => 'John Doe (id: 30)',
      'card' => $token['id']
    ));
  }

  /**
   * ----- list allのテスト -----
   * Customer::retrieve(customerID)に成功し、objectの値がcustomerであれり、cardsが実行されれば正しいとみなす
   */
  public function testListAll() {
    $customer = OmiseCustomer::retrieve($this->_customer['id']);
    $cards = $customer->cards();
    
    $this->assertArrayHasKey('object', $customer);
    $this->assertEquals('customer', $customer['object']);
  }

  /**
   * ----- ritrieveのテスト -----
   * Card::retrieve(cardID)に成功し、objectの値がcardであれば正しいとみなす
   */
  public function testRetrieve() {
    $customer = OmiseCustomer::retrieve($this->_customer['id']);
    $card = $customer->cards()->retrieve($this->_customer['cards']['data'][0]['id']);

    $this->assertArrayHasKey('object', $card);
    $this->assertEquals('card', $card['object']);
  }

  /**
   * ----- reloadのテスト -----
   * Card::reload(cardID)に成功し、objectの値がcardであれば正しいとみなす
   */
  public function testReload() {
    $customer = OmiseCustomer::retrieve($this->_customer['id']);
    $card = $customer->cards()->retrieve($this->_customer['cards']['data'][0]['id']);
    $card->reload();

    $this->assertArrayHasKey('object', $card);
    $this->assertEquals('card', $card['object']);
  }

  /**
   * ----- updateのテスト -----
   * Card::updateに成功し、update後の値が反映されていれば正しいとみなす
   */
  public function testUpdate() {
    $month = 11;
    $year = 2017;
    $name = 'Somchai Praset';
    $postalcode = '10310';

    $customer = OmiseCustomer::retrieve($this->_customer['id']);
    $card = $customer->cards()->retrieve($this->_customer['cards']['data'][0]['id']);
    $card->update(array(
      'expiration_month' => $month,
      'expiration_year' => $year,
      'name' => $name,
      'postal_code' => $postalcode
    ));

    $this->assertEquals($month, $card['expiration_month']);
    $this->assertEquals($year, $card['expiration_year']);
    $this->assertEquals($name, $card['name']);
    $this->assertEquals($postalcode, $card['postal_code']);
  }

  /**
   * ----- destroyのテスト -----
   * Card::destroyに成功し、destroyedのフラグが立っていれば正しいとみなす
   */
  public function testDestroy() {
    $customer = OmiseCustomer::retrieve($this->_customer['id']);
    $card = $customer->cards()->retrieve($this->_customer['cards']['data'][0]['id']);
    $this->_customer = null;
    $card->destroy();

    $this->assertTrue($card->isDestroyed());
  }

  /**
   * テストケースに使ったCustomerを削除する
   */
  public function tearDown() {
  	if($this->_customer != null) {
      $customer = OmiseCustomer::retrieve($this->_customer['id']);
      $card = $customer->cards()->retrieve($this->_customer['cards']['data'][0]['id']);
      $card->destroy();
    }
  }

  public static function tearDownAfterClass() {
    /** Do Nothing **/
  }
}
