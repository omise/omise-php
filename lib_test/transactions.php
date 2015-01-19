<?php

require_once dirname(__FILE__).'/../lib/Omise.php';

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

// list all
$transactions = OmiseTransaction::retrieve();

// retrieve
$transactions = OmiseTransaction::retrieve('trxn_test_4xuy2z4w5vmvq4x5pfs');
