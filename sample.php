<?php
require_once dirname(__FILE__).'/omise_test/OmiseAccountTest.php';

try {
	$accountTest = new OmiseAccountTest();
	$accountTest->retrieve();
} catch(OmiseException $e) {
	var_dump($e);
}

exit;
?>
