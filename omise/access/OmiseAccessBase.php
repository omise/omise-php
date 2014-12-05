<?php
require_once dirname(__FILE__).'/../exeption/Exceptions.php';
require_once dirname(__FILE__).'/../model/OmiseError.php';

class OmiseAccessBase {
	// リクエストメソッドたち
	const REQUEST_GET = 'GET';
	const REQUEST_POST = 'POST';
	const REQUEST_DELETE = 'DELETE';
	const REQUEST_PATCH = 'PATCH';

	// php-curlで使うオプションの設定
	const PARAM_TIMEOUT = 60;
	const PARAM_CONNECTTIMEOUT = 30;
	
	// OmiseのベースURL
	const URLBASE_API = 'https://api.omise.co';
	const URLBASE_VAULT = 'https://vault.omise.co';
	
	// Omiseの秘密鍵と公開鍵用変数
	protected $_secretkey, $_publickey;
	
	/**
	 * 引数にOmiseの秘密鍵と公開鍵を渡す
	 * @param string $secretkey
	 * @param string $publickey
	 */
	public function __construct($secretkey, $publickey) {
		$this->_secretkey = $secretkey;
		$this->_publickey = $publickey;
	}
	
	/**
	 * 戻り値は連想配列にされたjsonオブジェクト（ヘッダは含まない）
	 * @param string $url
	 * @param string $requestMethod
	 * @param array $params
	 * @throws OmiseException
	 * @return string
	 */
	protected function execute($url, $requestMethod, $params = null) {
		$ch = curl_init($url);
		curl_setopt_array($ch, $this->genOptions($requestMethod, $params));
		
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
			$omiseError = new OmiseError($array);
			$ex = new OmiseException($omiseError->getMessage().':Please run the "$[this exception]->getOmiseError();" for more information');
			$ex->setOmiseError($omiseError);
				
			throw $ex;
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
	private function genOptions($requestMethod, $params) {
		$options = array(
				// HTTPバージョンを1.1に指定
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				// リクエストメソッドの指定
				CURLOPT_CUSTOMREQUEST => $requestMethod,
				// その他HTTPヘッダが必要な場合に記述。現時点で指示無いため空欄 TODO
				CURLOPT_HTTPHEADER => array(
	
				),
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
				CURLOPT_FAILONERROR => true,
				// 実行時間の限界を指定
				CURLOPT_TIMEOUT => self::PARAM_TIMEOUT,
				// 接続要求のタイムアウトを指定
				CURLOPT_CONNECTTIMEOUT => self::PARAM_CONNECTTIMEOUT,
				// 認証情報を指定
				CURLOPT_USERPWD => $this->_secretkey.':'
		);
		
		// POSTパラメータがある場合マージ
		if(count($params) > 0) array_merge($options, array(CURLOPT_POSTFIELDS => http_build_query($params)));
	
		return $options;
	}
}