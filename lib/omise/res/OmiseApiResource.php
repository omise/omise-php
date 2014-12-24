<?php
require_once dirname(__FILE__).'/../../config.php';
require_once dirname(__FILE__).'/../exception/OmiseExceptions.php';
require_once dirname(__FILE__).'/obj/OmiseObject.php';

define('OMISE_API_URL', 'https://api.omise.co/');
define('OMISE_VAULT_URL', 'https://vault.omise.co/');

class OmiseApiResource extends OmiseObject {
	// リクエストメソッドたち
	const REQUEST_GET = 'GET';
	const REQUEST_POST = 'POST';
	const REQUEST_DELETE = 'DELETE';
	const REQUEST_PATCH = 'PATCH';
	
	// タイムアウトオプション
	private $OMISE_CONNECTTIMEOUT = 30;
	private $OMISE_TIMEOUT = 60;
	
	/**
	 * コンストラクタを呼ぶだけ。
	 * @param string $clazz
	 * @param string $secretkey
	 * @param string $publickey
	 * @throws Exception
	 * @return OmiseResource
	 */
	protected static function getInstance($clazz, $publickey = null, $secretkey = null) {
		if(class_exists($clazz)) {
			return new $clazz($publickey, $secretkey);
		} else {
			throw new Exception('Undefined class.');
		}
	}
	
	/**
	 * インスタンスを生成して取得
	 * @param string $clazz
	 * @param string $publickey
	 * @param string $secretkey
	 * @return OmiseAccount|OmiseBalance|OmiseCharges|OmiseCustomers|OmiseTokens|OmiseTransactions|OmiseTransfers
	 * @throws Exception|OmiseException
	 */
	protected static function retrieve($clazz, $url, $publickey = null, $secretkey = null) {
		$resource = $clazz::getInstance($clazz, $publickey, $secretkey);
		$result = $resource->execute($url, self::REQUEST_GET, $resource->getResourceKey());
		$resource->refresh($result);
		
		return $resource;
	}
	
	/**
	 * インスタンスを生成して新規作成
	 * @param string $clazz
	 * @param string $url
	 * @param array $params
	 * @param string $publickey
	 * @param string $secretkey
	 * @return OmiseAccount|OmiseBalance|OmiseCharges|OmiseCustomers|OmiseTokens|OmiseTransactions|OmiseTransfers
	 * @throws Exception|OmiseException
	 */
	protected static function create($clazz, $url, $params, $publickey = null, $secretkey = null) {
		$resource = $clazz::getInstance($clazz, $publickey, $secretkey);
		$result = $resource->execute($url, self::REQUEST_POST, $resource->getResourceKey(), $params);
		$resource->refresh($result);
		
		return $resource;
	}
	
	/**
	 * 更新処理
	 * @param string $url
	 * @param array $params
	 * @throws Exception|OmiseException
	 */
	protected function update($url, $params) {
		$result = $this->execute($url, self::REQUEST_PATCH, $this->getResourceKey(), $params);
		$this->refresh($result);
	}
	
	/**
	 * 削除処理
	 * @param string $url
	 * @return OmiseApiResource
	 * @throws Exception|OmiseException
	 */
	protected function destroy($url) {
		$result = $this->execute($url, self::REQUEST_DELETE, $this->getResourceKey());
		$this->refresh($result, true);
	}
	
	/**
	 * リロード処理
	 * @param string $url
	 * @throws Exception|OmiseException
	 */
	protected function reload($url) {
		$result = $this->execute($url, self::REQUEST_GET, $this->getResourceKey());
		$this->refresh($result);
	}
	
	/**
	 * 戻り値は連想配列にされたjsonオブジェクト（ヘッダは含まない）
	 * @param string $url
	 * @param string $requestMethod
	 * @param array $params
	 * @throws OmiseException
	 * @return string
	 */
	protected function execute($url, $requestMethod, $key, $params = null) {
		$ch = curl_init($url);
		curl_setopt_array($ch, $this->genOptions($requestMethod, $key.':', $params));
		// リクエストを実行し、失敗した場合には例外を投げる
		if(($result = curl_exec($ch)) === false) {
			$error = curl_error($ch);
			curl_close($ch);
				
			throw new Exception($error);
		}
		// 解放
		curl_close($ch);
		// 連想配列に格納し、エラーチェック
		$array = json_decode($result, true);
		
		// レスポンスが不正か、jsonでなかった
		if(count($array) === 0 || !isset($array['object'])) throw new Exception('This Exception is unknown.(Bad Response)');
		// レスポンスがerrorオブジェクトだった
		if($array['object'] === 'error') throw OmiseException::getInstance($array);
	
		return $array;
	}
	
	/**
	 * 引数にリクエストメソッドと、POSTしたい連想配列を渡す。
	 * 戻り値としてphp-curlのオプション配列が帰ってくる。
	 * @param string $requestMethod
	 * @param array $params
	 * @return array
	 */
	private function genOptions($requestMethod, $userpwd, $params) {
		$options = array(
				// HTTPバージョンを1.1に指定
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				// リクエストメソッドの指定
				CURLOPT_CUSTOMREQUEST => $requestMethod,
				// ユーザエージェントの設定
				CURLOPT_USERAGENT => "OmisePHP/".OMISE_PHP_LIB_VERSION." OmiseAPI/".OMISE_API_VERSION,
				// データを文字列で取得する
				CURLOPT_RETURNTRANSFER => true,
				// ヘッダは出力しない
				CURLOPT_HEADER => false,
				// リダイレクトを有効にする
				CURLOPT_FOLLOWLOCATION => true,
				// リダイレクトの最大カウントは3とする
				CURLOPT_MAXREDIRS => 3,
				// リダイレクトが実施されたときヘッダにRefererを追加する
				CURLINFO_HEADER_OUT=>true,
				CURLOPT_AUTOREFERER => true,
				// HTTPレスポンスコード400番台以上はエラーとして扱う
				//CURLOPT_FAILONERROR => true,
				// 実行時間の限界を指定
				CURLOPT_TIMEOUT => $this->OMISE_TIMEOUT,
				// 接続要求のタイムアウトを指定
				CURLOPT_CONNECTTIMEOUT => $this->OMISE_CONNECTTIMEOUT,
				// 認証情報を指定
				CURLOPT_USERPWD => $userpwd
		);
	
		// POSTパラメータがある場合マージ
		if(count($params) > 0) $options += array(CURLOPT_POSTFIELDS => http_build_query($params));
	
		return $options;
	}
	
	/**
	 * 削除済みかどうかチェックする
	 * @return OmiseApiResource
	 */
	protected function isDestroyed() {
		return $this['deleted'];
	}
	
	/**
	 * 秘密鍵を返す
	 * @return string
	 */
	protected function getResourceKey() {
		return $this->_secretkey;
	}
}
