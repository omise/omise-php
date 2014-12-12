The Omise PHP client supports the following PHP versions:
PHP 5.0以上
curl.so(php_curl)を使っています。

Usage
Tokensのcreateを叩くサンプル
-------------------------------------------------------------------------
require_once dirname(__FILE__).'/OmiseTest.php';
require_once dirname(__FILE__).'/../omise/Omise.php';
require_once dirname(__FILE__).'/../omise/model/OmiseTokenCreateInfo.php';

$omise = new Omise('public key', 'secret key');
		
$info = new OmiseTokenCreateInfo();
$info->setName('Somchai Prasert');
$info->setNumber('4242424242424242');
$info->setExpirationMonth(1);
$info->setExpirationYear(2018);
$info->setCity('Bangkok');
$info->setPostalCode('10320');

$omiseTokens = $omise->getOmiseAccessTokens()->create($info);
-------------------------------------------------------------------------

その他全てのAPI接続用ののサンプルは、omise_testディレクトリ以下のPHPコードにまとめられているのでそちらを御覧ください。