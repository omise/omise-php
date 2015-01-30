# Omise PHP Client

## Requirements

* PHP 5.3 and above.
* Built-in libcurl support.

## Installation

### Using Composer

You can install the library via [Composer](https://getcomposer.org/). If you don't already have Composer installed, first install it by following one of these instructions depends on your OS of choice:

* [Composer installation instruction for Windows](https://getcomposer.org/doc/00-intro.md#installation-windows)
* [Composer installation instruction for Mac OS X and Linux](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

After composer is installed, you can declare Omise-PHP as project dependency by creating a `composer.json` with the following content:

```json
{
  "require": {
    "omise/omise-php": "dev-master"
  }
}
```

Then run the following command to install the Omise-PHP library:

```
php composer.phar install
```

You can then add the following line to PHP script to load the library:

```php
require_once dirname(__FILE__).'/vendor/autoload.php';
```

Please see usage section below for usage examples.

### Manually

If you're not using Composer, you can also also clone the repository into the directory of your PHP script:

```
git clone https://github.com/omise/omise-php
```

However, using Composer is recommended as you can easily keep the library up-to-date. After cloning the repository, you can add the following line to PHP script to load the library:

```php
require_once dirname(__FILE__).'/omise-php/lib/Omise.php';
```

Please see usage section below for usage examples.

## Usage

Add the following to your PHP script and **replace the keys by the one given in Omise dashboard**:

```php
define('OMISE_PUBLIC_KEY', 'pkey_XXXXXXXXXXXXXXXXX');
define('OMISE_SECRET_KEY', 'skey_XXXXXXXXXXXXXXXXX');
```

Once both keys are set, you can now use the API. For example, to create a customer with a card returned from the token API (e.g. via the [card.js](https://docs.omise.co/card-js/)):

```php
$customer = OmiseCustomer::create(array(
  'email' => 'john.doe@example.com',
  'description' => 'John Doe (id: 30)',
  'card' => 'tokn_test_4xs9408a642a1htto8z'
));
```

To retrieve, update and destroy that customer:

```php
$customer = OmiseCustomer::retrieve('cust_test_4xtrb759599jsxlhkrb');
$customer->update(array('description' => 'John W. Doe'));
$customer->destroy();
$customer->isDestroyed();  // => true
```

For full usage, please refer to [API documentation](https://docs.omise.co/). You may also refer to example in the `tests/Omise` directory.

## Testing

To run an automated test suite, first replace your keys in `tests/omise/TestConfig.php`:

```php
define('OMISE_PUBLIC_KEY', 'pkey_XXXXXXXXXXXXXXXXX');
define('OMISE_SECRET_KEY', 'skey_XXXXXXXXXXXXXXXXX');
```

Then run the PHPUnit:

```
phpunit omise-php/tests/omise/AccountTest
```

## License

See LICENSE.txt
