<?php
require_once dirname(__FILE__).'/../lib/Omise.php';

$account = OmiseAccount::retrieve();
$account->reload();
var_dump($account);