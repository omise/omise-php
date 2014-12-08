<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';
require_once dirname(__FILE__).'/../model/OmiseTokens.php';
require_once dirname(__FILE__).'/../model/OmiseCardCreateInfo.php';

class OmiseAccessTokens extends OmiseAccessBase {
	const PARAM_CARD_NAME = 'card[name]';
	const PARAM_CARD_NUMBER = 'card[number]';
	const PARAM_CARD_EXPIRATION_MONTH = 'card[expiration_month]';
	const PARAM_CARD_EXPIRATION_YEAR = 'card[expiration_year]';
	const PARAM_CARD_SECURITY_CODE = 'card[security_code]';
	const PARAM_CARD_POSTAL_CODE = 'card[postal_code]';
	const PARAM_CARD_CITY = 'card[city]';
	
	/**
	 * トークンを作成する。引数はCardCreateInfoオブジェクト
	 * @param OmiseCardCreateInfo $card
	 * @return OmiseTokens
	 */
	function create($cardCreateInfo) {
		$param = array(
			self::PARAM_CARD_NAME => $cardCreateInfo->getName(),
			self::PARAM_CARD_NUMBER => $cardCreateInfo->getNumber(),
			self::PARAM_CARD_EXPIRATION_MONTH => $cardCreateInfo->getExpirationMonth(),
			self::PARAM_CARD_EXPIRATION_YEAR => $cardCreateInfo->getExpirationYear(),
			self::PARAM_CARD_SECURITY_CODE => $cardCreateInfo->getSecurityCode(),
			self::PARAM_CARD_POSTAL_CODE => $cardCreateInfo->getPostalCode(),
			self::PARAM_CARD_CITY => $cardCreateInfo->getCity()
		);
		$array = parent::execute(parent::URLBASE_VAULT.'/tokens', parent::REQUEST_POST, $this->_publickey, $param);
		
		return new OmiseTokens($array);
	}
	
	/**
	 * トークンIDに紐づく情報を再取得する
	 * @param string $tokenID
	 * @return OmiseTokens
	 */
	function retrieve($tokenID) {
		$array = parent::execute(parent::URLBASE_VAULT.'/tokens/'.$tokenID, parent::REQUEST_GET, $this->_publickey);
		
		return new OmiseTokens($array);
	}
}
