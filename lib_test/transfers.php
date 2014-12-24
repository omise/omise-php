<?php
require_once dirname(__FILE__).'/../lib/Omise.php';

$transfer = OmiseTransfer::retrieve();

$transfer = OmiseTransfer::retrieve('trsf_test_4xs5px8c36dsanuwztf');

$transfer = OmiseTransfer::retrieve('trsf_test_4xs5px8c36dsanuwztf');
$transfer['amount'] = 50000;
$transfer->save();

$transfer = OmiseTransfer::retrieve('trsf_test_4xs5px8c36dsanuwztf');
$transfer->destroy();
$transfer->isDestroyed();
