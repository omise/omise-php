# Omise PHP Client

`omise-php` is Omise API library written in PHP.

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

### API version

You can choose which API version to use with Omise. Each API version has new features and might not be compatible with previous versions. You can change the default version by visiting your Omise Dashboard.

To overwrite the API version to use, you can specify it by defining OMISE_API_VERSION.
The version configured here will have higher priority than the version set in your Omise account.
This is useful if you have multiple environments with different API versions for testing.
(e.g. Development on the latest version but production is on an older version).

```php
require_once dirname(__FILE__).'/omise-php/lib/Omise.php';

define('OMISE_API_VERSION', '2014-07-27');
```

It is highly recommended to set this version to the current version
you're using.

## Usage

### 1. Flow

The following flow is recommended in order to comply with the PCI Security Standards.
You should never transmit card data through your servers unless you have a valid PCI certificate.

### Flow using Omise.js
1. User enters the credit card information on a form on your site, completely white-label (user never sees Omise).
2. The card is sent directly from the browser to Omise server via HTTPS using our Javascript (Omise.js).
3. Omise returns a Token that identifies the card and if the card passed the authorization `card.security_code_check`
4. Your page will send this token to your server to finally make the charge capture.

### Notes:
In step 3, if `card.security_code_check` is `false`, the card failed the authorization process, probably because of a wrong CVV, wrong expire date or wrong card number. In this case you should display an error message and ask user to enter card again.

In step 4, Omise will make the final capture of the amount. If this fails, but token was authorized, it can be due to card having no funds required for the charge.

### The Code

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

To run an automated test suite, make sure you already have a [PHPUnit](https://phpunit.de/) in your local machine.
Then run the PHPUnit:

```
phpunit omise-php/tests
```

If you want to run with a specific test, let's try

```
phpunit omise-php/tests/omise/AccountTest
```

## License

See LICENSE.txt
