<?php
require_once dirname(__FILE__).'/OmiseApiResource.php';

class OmiseVaultResource extends OmiseApiResource {
	/**
	 * 公開鍵を返す
	 * @return string
	 */
	protected function getResourceKey() {
		return $this->_publickey;
	}
}
