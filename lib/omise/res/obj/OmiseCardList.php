<?php
require_once dirname(__FILE__).'/OmiseList.php';
require_once dirname(__FILE__).'/../../OmiseCards.php';

class OmiseCardList extends OmiseList {
	/**
	 * $customerのarrayを受け取り、OmiseCardsを生成しつつpushしていく
	 * @param array $customer
	 * @param string $publickey
	 * @param string $secretkey
	 */
	public function __construct($customer, $publickey = null, $secretkey = null) {
		parent::__construct($publickey, $secretkey);
		
		foreach ($customer['cards']['data'] as $row) {
			$this->push(new OmiseCards($row, $customer['id']));
		}
	}
	
	/**
	 * retrieveする。が、生成済みのインスタンスを返すだけ
	 * @param stroing $id
	 * @return OmiseCards
	 */
	public function retrieve($id) {
		foreach ($this as $row) {
			if($row['id'] === $id) return $row;
		}
	}
}