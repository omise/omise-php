<?php
require_once dirname(__FILE__).'/res/obj/OmiseList.php';

class OmiseCardList extends OmiseList {
	function a() {
		$cards = OmiseCards::getInstance(null, null);
	}
}