<?php

require_once dirname(__FILE__).'/../lib/Omise.php';

// retrieve
$balance = OmiseBalance::retrieve();
$balance->reload();
