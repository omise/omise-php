<?php
require_once dirname(__FILE__).'/../../config.php';
require_once dirname(__FILE__).'/../object/OmiseObject.php';
require_once dirname(__FILE__).'/../exception/OmiseException.php';

class OmiseApiResource extends OmiseObject {
	// リクエストメソッドたち
	const REQUEST_GET = 'GET';
	const REQUEST_POST = 'POST';
	const REQUEST_DELETE = 'DELETE';
	const REQUEST_PATCH = 'PATCH';
	
	// タイムアウトオプション
	private $OMISE_CONNECTTIMEOUT = 30;
	private $OMISE_TIMEOUT = 60;
	
	// OmiseのベースURL
	protected $_apiUrl = 'https://api.omise.co/';
	protected $_vaultUrl = 'https://vault.omise.co/';
	protected $_endpoint = '';
	
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
	 * リソースを生成してretriveする
	 * @param string $clazz
	 * @param string $publickey
	 * @param string $secretkey
	 * @return OmiseAccount|OmiseBalance
	 */
	protected static function retrive($clazz, $publickey = null, $secretkey = null) {
		$resource = $clazz::getInstance($clazz, $publickey, $secretkey);
		$resource->reload();
		
		return $resource;
	}
	protected static function create($clazz, $params, $publickey = null, $secretkey = null) {
		$resource = $clazz::getInstance($clazz, $publickey, $secretkey);
		$result = $resource->execute($resource->getUrl(), self::REQUEST_POST, $resource->getResourceKey(), $params);
		$resource->refresh($result);
		
		return $resource;
	}
	protected function reload() {
		$result = $this->execute($this->getUrl(), self::REQUEST_GET, $this->getResourceKey());
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
	private function execute($url, $requestMethod, $key, $params = null) {
		$ch = curl_init($url);
		curl_setopt_array($ch, $this->genOptions($requestMethod, $key.':', $params));
		// リクエストを実行し、失敗した場合には例外を投げる
		if(($result = curl_exec($ch)) === false) {
			$error = curl_error($ch);
			curl_close($ch);
				
			throw new OmiseException($error);
		}
		// 解放
		curl_close($ch);
		// 連想配列に格納し、エラーチェック
		$array = json_decode($result, true);
		if(count($array) === 0) throw new OmiseException('This Exception is unknown.(Bad Response)');
	
		if($array['object'] === 'error') {
			var_dump($array);
		}
	
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
	
	/* ----------- APIのURLを取得するメソッドたち ----------- */
	// アクセスすべきURLを取得する
	protected function getUrl($id = '') {
		return $this->getResourceURL().$this->getLocation($id);
	}
	// ベースURL以下のロケーションを返す
	protected function getLocation($id = '') {
		return $this->_endpoint.'/'.$id;
	}
	// APIリソースを返す
	protected function getResourceURL() {
		return $this->_apiUrl;
	}

	/* ----------- ただのアクセサ ----------- */
	protected function getResourceKey() {
		return $this->_secretkey;
	}
}