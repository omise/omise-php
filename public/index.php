<?php

require_once '../vendor/autoload.php';

define('OMISE_PUBLIC_KEY', 'pkey_test_5reg95nq4k1p83i558l');
define('OMISE_SECRET_KEY', 'skey_test_5reg95paifpac10cwgj');
define('OMISE_API_VERSION', '2017-11-02');

$account = OmiseAccount::retrieve();

echo $account['email'];