<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';
require_once dirname(__FILE__).'/../model/OmiseTokens.php';

class OmiseAccessTokens extends OmiseAccessBase {
	const PARAM_CARD_NAME = 'card[name]';
	const PARAM_CARD_NUMBER = 'card[number]';
	const PARAM_CARD_EXPIRATION_MONTH = 'card[expiration_month]';
	const PARAM_CARD_EXPIRATION_YEAR = 'card[expiration_year]';
	const PARAM_CARD_SECURITY_CODE = 'card[security_code]';
	const PARAM_CARD_POSTAL_CODE = 'card[postal_code]';
	const PARAM_CARD_CITY = 'card[city]';
	
	/**
	 * @throws OmiseException
	 * @return OmiseTokens
	 */
	function create($card) {
		$array = parent::execute(parent::URLBASE_VAULT.'/tokens', parent::REQUEST_POST);
		
		return new OmiseTokens($array);
	}
}
