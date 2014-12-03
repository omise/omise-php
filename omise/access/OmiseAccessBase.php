<?php
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
	protected $_secretkey;
	protected $_publickey;
	
	/**
	 * 引数にOmiseの秘密鍵と公開鍵を渡す
	 * @param string $secretkey
	 * @param string $publickey
	 */
	function __construct($secretkey, $publickey) {
		$this->_secretkey = $secretkey;
		$this->_publickey = $publickey;
	}
	
	function execute($url, $requestMethod, $params = null) {
		$ch = curl_init($url);
		curl_setopt_array($ch, $this->genOptions($requestMethod, $params));
		
		// リクエストを実行し、失敗した場合には例外を投げる
		if(($result = curl_exec($ch)) === false) {
			$responsCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			curl_close($ch);
			if($responsCode === null) {
				throw new OmiseConnectionException('Connection timeout.');
			}else if($responsCode > 500) {
				throw new OmiseConnectionException('Server error. Status code:'.$responsCode);
			} else if($responsCode > 400) {
				throw new OmiseConnectionException('Client error. Status code:'.$responsCode);
			} else if($responsCode > 300) {
				throw new OmiseConnectionException('Too many redirection. Status code:'.$responsCode);
			} else {
				throw new OmiseUnknownException('unknown exception ');
			}
		}
		
		curl_close($ch);
		return $result;
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
				// その他HTTPヘッダが必要な場合に記述
				CURLOPT_HTTPHEADER => array(
	
				),
				// データを文字列で取得する
				CURLOPT_RETURNTRANSFER => true,
				// ヘッダは出力しない
				CURLOPT_HEADER => false,
				// POSTパラメータ等を付記
				CURLOPT_POSTFIELDS => http_build_query($params),
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
	
		return $options;
	}
}