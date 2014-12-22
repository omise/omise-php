<?php
require_once dirname(__FILE__).'/OmiseApiResource.php';

class OmiseVaultResource extends OmiseApiResource {
	protected function getResourceKey() {
		return $this->_publickey;
	}
}
