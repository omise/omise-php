<?php

require_once dirname(__FILE__).'/../lib/Omise.php';

// list all
$transactions = OmiseTransaction::retrieve();

// retrieve
$transactions = OmiseTransaction::retrieve('trxn_test_4xuy2z4w5vmvq4x5pfs');
