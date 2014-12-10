<?php
abstract class OmiseTest {
	protected $_secretkey, $_publickey ;
	
	public function __construct($publickey, $secretkey) {
		$this->_secretkey = $secretkey;
		$this->_publickey = $publickey;
	}
}