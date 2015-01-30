<?php

require_once dirname(__FILE__).'/TestConfig.php';
if(version_compare(phpversion(), '5.3.2') >= 0 && file_exists(dirname(__FILE__).'/../../vendor/autoload.php')) {
  require_once dirname(__FILE__).'/../../vendor/autoload.php';
} else {
  require_once dirname(__FILE__).'/../../lib/Omise.php';
}

class CardTest extends PHPUnit_Framework_TestCase {
  private $_customer;

  public static function setUpBeforeClass() {
  	/** Do Nothing **/
  }

  /**
   * Setup the customer to be used in test cases.
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
   * ----- Test list all -----
   * Assert that a list of card object could be successfully retrieved from customer.
   */
  public function testListAll() {
    $customer = OmiseCustomer::retrieve($this->_customer['id']);
    $cards = $customer->cards();

    $this->assertArrayHasKey('object', $cards);
    $this->assertEquals('list', $cards['object']);
  }

  /**
   * ----- Test retrieve -----
   * Assert that a card is could be successfully retrieved from customer.
   */
  public function testRetrieve() {
    $customer = OmiseCustomer::retrieve($this->_customer['id']);
    $card = $customer->cards()->retrieve($this->_customer['cards']['data'][0]['id']);

    $this->assertArrayHasKey('object', $card);
    $this->assertEquals('card', $card['object']);
  }

  /**
   * ----- Test reload -----
   * Assert that a card object is returned after a successful reload.
   */
  public function testReload() {
    $customer = OmiseCustomer::retrieve($this->_customer['id']);
    $card = $customer->cards()->retrieve($this->_customer['cards']['data'][0]['id']);
    $card->reload();

    $this->assertArrayHasKey('object', $card);
    $this->assertEquals('card', $card['object']);
  }

  /**
   * ----- Test update -----
   * Assert that a card is successfully updated with the given parameters set.
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
   * ----- Test destroy -----
   * Assert that a destroyed flag is set after a card is successfully destroyed.
   */
  public function testDestroy() {
    $customer = OmiseCustomer::retrieve($this->_customer['id']);
    $card = $customer->cards()->retrieve($this->_customer['cards']['data'][0]['id']);
    $this->_customer = null;
    $card->destroy();

    $this->assertTrue($card->isDestroyed());
  }

  /**
   * Remove the customer used in test cases.
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
