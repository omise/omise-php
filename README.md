# Omise PHP Client

## Requirements

* PHP 5.0 and above.
* Built-in libcurl support.

## Installation

In order to use the library, first clone this repository to the directory of your PHP script with:

```
git clone https://github.com/omise/omise-php
```

## Usage

Add the following to your PHP script and replace the keys by the one given in Omise dashboard:

```php
require_once dirname(__FILE__).'/omise-php/lib/Omise.php';

define('OMISE_PUBLIC_KEY', 'pkey_XXXXXXXXXXXXXXXXX');
define('OMISE_SECRET_KEY', 'skey_XXXXXXXXXXXXXXXXX');
```

Please see [API documentation](https://docs.omise.co/) for full API usage. You may also refer to usage example in the `omise_test` directory.

After both keys are set, you can now use the API. For example, to create a customer without any cards associated to the customer:

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

## License

See LICENSE.txt
