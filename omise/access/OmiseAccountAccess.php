<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';

class OmiseAccountAccess extends OmiseAccessBase {
	function retrieve() {
		var_dump(json_decode($this->execute(parent::URLBASE_API.'/account', parent::REQUEST_GET)));
	}
}
?>