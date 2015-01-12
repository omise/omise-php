<?php

require_once dirname(__FILE__).'/../lib/Omise.php';

// list all
$charge = OmiseCharge::retrieve();

// create
$charge = OmiseCharge::create(array(
	'return_uri' => 'https://example.co.th/orders/384/complete',
	'amount' => 100000,
	'currency' => 'thb',
	'description' => 'Order-384',
	'ip' => '127.0.0.1',
	'card' => 'tokn_test_4xs9408a642a1htto8z'
));

// retrieve
$charge = OmiseCharge::retrieve('chrg_test_4xso2s8ivdej29pqnhz');

// update
$charge = OmiseCharge::retrieve('chrg_test_4xso2s8ivdej29pqnhz');
$charge->update(array(
		'description' => 'Another description'
));

// capture
$charge = OmiseCharge::retrieve('chrg_test_4xso2s8ivdej29pqnhz');
$charge->capture();
