<?php
require_once dirname(__FILE__).'/../lib/Omise.php';

$charge = OmiseCharge::retrieve();

$charge = OmiseCharge::create(array(
	'return_uri' => 'https://example.co.th/orders/384/complete',
	'amount' => 100000,
	'currency' => 'thb',
	'description' => 'Order-384',
	'ip' => '127.0.0.1',
	'card' => 'tokn_test_4yhjzedpby2e0e75rbe'
));

$charge = OmiseCharge::retrieve('chrg_test_4yhk6j3a5kcbzr1m3kg');

$charge = OmiseCharge::retrieve('chrg_test_4yhk6j3a5kcbzr1m3kg');
$charge->update(array(
	'description' => 'Another description'
));

$charge = OmiseCharge::retrieve('chrg_test_4yhk6j3a5kcbzr1m3kg');
$charge->capture();
var_dump($charge);