<?php
abstract class OmiseTest {
	protected $_secretkey, $_publickey ;
	
	public function __construct($publickey, $secretkey) {
		$this->_publickey = $publickey;
		$this->_secretkey = $secretkey;
	}
}