<?php

namespace Omise\OmisePHP\Res\Obj;

require_once dirname(__FILE__).'/OmiseList.php';
require_once dirname(__FILE__).'/../../OmiseCard.php';

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
      $this->refresh(array($row['id'] => new OmiseCard($row, $customer['id'])));
    }
  }
  
  /**
   * retrieveする。が、生成済みのインスタンスを返すだけ
   * @param stroing $id
   * @return OmiseCard
   */
  public function retrieve($id) {
    if(isset($this[$id])) return $this[$id];
  }
}