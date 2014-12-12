# Omise PHP Client

## The Omise PHP client supports the following PHP versions:
PHP 5.0以上
curl.so(php_curl)を使っています。

## Example
Tokensのcreateを叩くサンプル

APIへのアクセスは全てOmiseTestを経由して行います。
```php
require_once dirname(__FILE__).'/OmiseTest.php';
require_once dirname(__FILE__).'/../omise/Omise.php';
require_once dirname(__FILE__).'/../omise/model/OmiseTokenCreateInfo.php';
```

OmiseTestのインスタンスを生成します。
```php
$omise = new Omise('public key', 'secret key');
```

Tokenを作成するためのモデルOmiseTokenCreateInfoインスタンスを生成します。
```php
$info = new OmiseTokenCreateInfo();
$info->setName('Somchai Prasert');
$info->setNumber('4242424242424242');
$info->setExpirationMonth(1);
$info->setExpirationYear(2018);
$info->setCity('Bangkok');
$info->setPostalCode('10320');
```

OmiseTestから、API:Tokensに接続するためのオブジェクトを経由してTokenの作成を行います。
```php
$omiseTokens = $omise->getOmiseAccessTokens()->create($info);
```

※その他全てのAPI接続用ののサンプルは、omise_testディレクトリ以下のPHPコードにまとめられているのでそちらを御覧ください。