<?php
require_once dirname(__FILE__).'/OmiseResource.php';

class OmiseResourceVault extends OmiseResource {
	// vault用のAPIリソースを返す
	protected function getResourceURL() {
		return $this->_apiUrl;
	}
	protected function getResourceKey() {
		return $this->_secretkey;
	}
}