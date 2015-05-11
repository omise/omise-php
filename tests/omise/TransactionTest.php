<?php require_once dirname(__FILE__).'/TestConfig.php';

class TransactionTest extends TestConfig {
  /**
   * OmiseTransaction should contain some method like below.
   *
   */
  public function testOmiseTransactionMethodExists() {
    $this->assertTrue(method_exists('OmiseTransaction', 'retrieve'));
    $this->assertTrue(method_exists('OmiseTransaction', 'reload'));
    $this->assertTrue(method_exists('OmiseTransaction', 'getUrl'));
  }

  /**
   * Assert that a list of transactions object could be successfully retrieved.
   *
   */
  public function testRetrieveAllTransactions() {
    $transactions = OmiseTransaction::retrieve();

    $this->assertArrayHasKey('object', $transactions);
    $this->assertEquals('list', $transactions['object']);
  }

  /**
   * Assert that a transaction object is returned after a successful retrieve with transaction id.
   *
   */
  public function testRetrieveWithSpecificTransaction() {
    $transaction = OmiseTransaction::retrieve('trxn_test_4zmrjhlflnz6id6q0bo');

    $this->assertArrayHasKey('object', $transaction);
    $this->assertEquals('transaction', $transaction['object']);
  }

  /**
   * Assert that a transaction object is returned after a successful retrieve with transaction id.
   * And validate json structure that's return back.
   *
   */
  public function testValidateOmiseTransactionObjectRetrievedStructure() {
    $transaction = OmiseTransaction::retrieve('trxn_test_4zmrjhlflnz6id6q0bo');

    $this->assertArrayHasKey('object', $transaction);
    $this->assertArrayHasKey('id', $transaction);
    $this->assertArrayHasKey('type', $transaction);
    $this->assertArrayHasKey('amount', $transaction);
    $this->assertArrayHasKey('currency', $transaction);
    $this->assertArrayHasKey('created', $transaction);
  }
}
