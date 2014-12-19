<?php
require_once dirname(__FILE__).'/OmiseApiResource.php';

class OmiseVaultResource extends OmiseApiResource {
	// vault用のAPIリソースを返す
	protected function getResourceURL() {
		return $this->_vaultUrl;
	}
	protected function getResourceKey() {
		return $this->_publickey;
	}
}