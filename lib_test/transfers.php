<?php

require_once dirname(__FILE__).'/../lib/Omise.php';

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

// list all
$transfers = OmiseTransfer::retrieve();

// retrieve
$transfer = OmiseTransfer::retrieve('trsf_test_4y3miv1nhy0dceit4w4');

// create 
$transfer = OmiseTransfer::create(array(
	'amount' => 100000
));

// update
$transfer = OmiseTransfer::retrieve('trsf_test_4y3miv1nhy0dceit4w4');
$transfer['amount'] = 50000;
$transfer->save();

// destroy
$transfer = OmiseTransfer::retrieve('trsf_test_4y3miv1nhy0dceit4w4');
$transfer->destroy();
$transfer->isDestroyed();
