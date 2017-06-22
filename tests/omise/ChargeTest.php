<?php require_once dirname(__FILE__).'/TestConfig.php';

class ChargeTest extends TestConfig {
  /**
   * OmiseCharge class must be contain some method below.
   *
   */
  public function testMethodExists() {
    $this->assertTrue(method_exists('OmiseCharge', 'reload'));
    $this->assertTrue(method_exists('OmiseCharge', 'create'));
    $this->assertTrue(method_exists('OmiseCharge', 'update'));
    $this->assertTrue(method_exists('OmiseCharge', 'capture'));
    $this->assertTrue(method_exists('OmiseCharge', 'reverse'));
    $this->assertTrue(method_exists('OmiseCharge', 'refunds'));
    $this->assertTrue(method_exists('OmiseCharge', 'getUrl'));
  }

  /**
   * Assert that a list of charge object could be successfully retrieved.
   *
   */
  public function testRetrieveChargeListObject() {
    $charge = OmiseCharge::retrieve();

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('list', $charge['object']);
  }

  /**
   * Assert that a charge is successfully created with the given parameters set.
   *
   */
  public function testCreate() {
    $charge = OmiseCharge::create(array('amount'      => 100000,
                                        'currency'    => 'thb',
                                        'description' => 'Order-384',
                                        'ip'          => '127.0.0.1',
                                        'card'        => 'tokn_test_4zmrjhuk2rndz24a6x0'));

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('charge', $charge['object']);
  }

  /**
   * Assert that a charge object is returned after a successful retrieve.
   *
   */
  public function testRetrieveSpecificChargeObject() {
    $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('charge', $charge['object']);
  }

  /**
   * Assert that a charge is successfully updated with the given parameters set.
   *
   */
  public function testUpdate() {
    $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');
    $charge->update(array('description' => 'Another description'));

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('charge', $charge['object']);
  }

  /**
   * Assert that a captured flag is set after charge is successfully captured.
   *
   * In our test environment, the charge will be auto-captured after create
   * and this test will raise OmiseFailedCaptureException.
   *
   */
  public function testCapture() {
    $charge = OmiseCharge::retrieve('chrg_test_4zmrjgxdh4ycj2qncoj');
    $charge->capture();

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('charge', $charge['object']);
    $this->assertTrue($charge['captured']);
  }

  /**
   * Assert that a reversed flag is set after charge is successfully reversed.
   *
   */
  public function testReverse() {
    $charge = OmiseCharge::retrieve('chrg_test_53z5zoeovi39e1erbj0');
    $charge->reverse();

    $this->assertArrayHasKey('object', $charge);
    $this->assertEquals('charge', $charge['object']);
    $this->assertTrue($charge['reversed']);
  }

  /**
   * Assert that OmiseCharge can search for charges.
   */
  public function testSearch() {
    $result = OmiseCharge::search('order')
      ->filter(array('captured' => true))
      ->page(2)
      ->order('reverse_chronological');

    $this->assertTrue($result->isDirty());
    $this->assertArrayHasKey('object', $result);
    $this->assertEquals('search', $result['object']);
    $this->assertFalse($result->isDirty());

    foreach ($result['data'] as $item) {
      $this->assertArrayHasKey('object', $item);
      $this->assertEquals('charge', $item['object']);
    }

    $result = $result->page(1);
    $this->assertTrue($result->isDirty());
    $result->reload();
    $this->assertFalse($result->isDirty());

    $this->assertArrayHasKey('object', $result);
    $this->assertEquals('search', $result['object']);

    foreach ($result['data'] as $item) {
      $this->assertArrayHasKey('object', $item);
      $this->assertEquals('charge', $item['object']);
    }
  }

  /**
   * @test
   */
  public function retrieve_schedules()
  {
    $schedules = OmiseCharge::schedules();

    $this->assertArrayHasKey('object', $schedules);
    $this->assertEquals('list', $schedules['object']);
    $this->assertEquals('schedule', $schedules['data'][0]['object']);
    $this->assertArrayHasKey('charge', $schedules['data'][0]);
  }

  /**
   * @test
   */
  public function create_scheduler()
  {
    $charge = array(
      'customer' => 'cust_test_58e7azwu6owk31ok81y',
      'amount'   => 99900
    );

    $scheduler = OmiseCharge::schedule($charge);

    $this->assertEquals($charge, $scheduler['charge']);
  }
}
