<?php

require_once dirname(__FILE__).'/../lib/Omise.php';

define('OMISE_PUBLIC_KEY', 'pkey');
define('OMISE_SECRET_KEY', 'skey');

// retrieve
$account = OmiseAccount::retrieve();
$account->reload();
