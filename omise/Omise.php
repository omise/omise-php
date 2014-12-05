<?php
require_once dirname(__FILE__).'/access/OmiseAccessAccount.php';

try {
	$var = (new OmiseAccessAccount('skey_test_4y9cewl0rgwji2kbbcb', 'pkey_test_4y9cewl0s1osh44ouud'))->retrieve();
	
	var_dump($var->getObject());
} catch(Exception $e) {
	echo($e->getMessage());
}