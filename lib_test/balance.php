<?php
require_once dirname(__FILE__).'/../lib/Omise.php';

$balance = OmiseBalance::retrieve();
$balance->reload();
var_dump($balance);