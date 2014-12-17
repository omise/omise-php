<?php
class OmiseRequestAccount extends OmiseSingleton {
	public static function getInstance() {
		return parent::getInstance(get_class());
	}
	
	
}