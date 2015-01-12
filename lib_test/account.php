<?php

require_once dirname(__FILE__).'/../lib/Omise.php';

// retrieve
$account = OmiseAccount::retrieve();
$account->reload();
