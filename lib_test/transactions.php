<?php
require_once dirname(__FILE__).'/../lib/Omise.php';

$transactions = OmiseTransaction::retrieve();

$transactions = OmiseTransaction::retrieve('trxn_test_4ycwqknctg60337rhh3');