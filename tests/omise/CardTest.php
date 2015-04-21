<?php require_once dirname(__FILE__).'/TestConfig.php';

class CardTest extends TestConfig {
  /**
   * OmiseCard class must be contain some method below.
   *
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseCard', 'reload'));
    $this->assertTrue(method_exists('OmiseCard', 'update'));
    $this->assertTrue(method_exists('OmiseCard', 'destroy'));
    $this->assertTrue(method_exists('OmiseCard', 'isDestroyed'));
    $this->assertTrue(method_exists('OmiseCard', 'getUrl'));
  }

  /**
   * Assert that a list of card object could be successfully retrieved from customer.
   *
   */
  public function testRetrieveCustomerCardListObject() {
    $customer = OmiseCustomer::retrieve('cust_test_4zmrjg2hct06ybwobqc');
    $cards = $customer->cards();

    $this->assertArrayHasKey('object', $cards);
    $this->assertEquals('list', $cards['object']);
  }

  /**
   * Assert that a card is could be successfully retrieved from customer.
   *
   */
  public function testRetrieveSpecificCustomerCardObject() {
    $customer = OmiseCustomer::retrieve('cust_test_4zmrjg2hct06ybwobqc');
    $card = $customer->cards()->retrieve('card_test_4zmrjfzf0spz3mh63cs');

    $this->assertArrayHasKey('object', $card);
    $this->assertEquals('card', $card['object']);
  }

  /**
   * Assert that a card object is returned after a successful reload.
   *
   */
  public function testReload() {
    $customer = OmiseCustomer::retrieve('cust_test_4zmrjg2hct06ybwobqc');
    $card = $customer->cards()->retrieve('card_test_4zmrjfzf0spz3mh63cs');
    $card->reload();

    $this->assertArrayHasKey('object', $card);
    $this->assertEquals('card', $card['object']);
  }

  /**
   * Assert that a card is successfully updated with the given parameters set.
   *
   */
  public function testUpdate() {
    $customer = OmiseCustomer::retrieve('cust_test_4zmrjg2hct06ybwobqc');
    $card = $customer->cards()->retrieve('card_test_4zmrjfzf0spz3mh63cs');
    $card->update(array('expiration_month'  => 11,
                        'expiration_year'   => 2017,
                        'name'              => 'Somchai Praset',
                        'postal_code'       => '10310'));

    $this->assertArrayHasKey('object', $card);
    $this->assertEquals('card', $card['object']);
  }

  /**
   * Assert that a destroyed flag is set after a card is successfully destroyed.
   *
   */
  public function testDestroy() {
    $customer = OmiseCustomer::retrieve('cust_test_4zmrjg2hct06ybwobqc');
    $card = $customer->cards()->retrieve('card_test_4zmrjfzf0spz3mh63cs');
    $card->destroy();

    $this->assertArrayHasKey('object', $card);
    $this->assertEquals('card', $card['object']);
    $this->assertTrue($card->isDestroyed());
  }
}
