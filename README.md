# Omise PHP Client

[![](https://img.shields.io/badge/discourse-forum-1a53f0.svg?style=flat-square&logo=data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAOCAYAAAAfSC3RAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAVlpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IlhNUCBDb3JlIDUuNC4wIj4KICAgPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICAgICAgPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIKICAgICAgICAgICAgeG1sbnM6dGlmZj0iaHR0cDovL25zLmFkb2JlLmNvbS90aWZmLzEuMC8iPgogICAgICAgICA8dGlmZjpPcmllbnRhdGlvbj4xPC90aWZmOk9yaWVudGF0aW9uPgogICAgICA8L3JkZjpEZXNjcmlwdGlvbj4KICAgPC9yZGY6UkRGPgo8L3g6eG1wbWV0YT4KTMInWQAAAqlJREFUKBU9UVtLVFEU%2FvY%2B27mPtxl1dG7HbNRx0rwgFhJBPohBL9JTZfRQ0YO9RU%2FVL6iHCIKelaCXqIewl4gEBbEyxSGxzKkR8TbemmbmnDlzVvsYtOHbey1Y317fWh8DwCVMCfSHww3ElCs7CjuzbOcNIaEo9SbtlDRjZiNPY%2BvrqSWrTh7l3yPvrmh0KBZW59HcREjEqcGpElAuESRxopU648dTwfrIyH%2BCFXSH1cFgJLqHlma6443SG0CfqYY2NZjQnkV8eiMgP6ijjnizHglErlocdl5VA0mT3v102dseL2W14cYM99%2B9XGY%2FlQArd8Mo6JhbSJUePHytvf2UdnW0qen93cKQ4nWXX1%2FyOkZufsuZN0L7PPzkthDDZ4FQLajSA6XWR8HWIK861sCfj68ggGwl83mzfMclBmAQ%2BktrqBu9wOhcD%2BB0ErSiFFyEkdcYhKD27mal9%2F5FY36b4BB%2FTvO8XdQhlUe11F3WG2fc7QLlC8wai3MGGQCGDkcZQyymCqAPSmati3s45ygWseeqADwuWS%2F3wGS5hClDMMstxvJFHQuGU26yHsY6iHtL0sIaOyZzB9hZz0hHZW71kySSl6LIJlSgj5s5LO6VG53aFgpOfOFCyoFmYsOS5HZIaxVwKYsLSbJJn2kfU%2BlNdms5WMLqQRklX0FX26eFRnKYwzX0XRsgR0uUrWxplM7oqPIq8r8cZrdLNLqaABayxZMTTx2HVfglbP4xkcvqZEMNfmglevRi1ny5mGfJfTuQiBEq%2FMBvG0NqDh2TY47sbtJAuO%2Fe9%2Fn3STRFosm2WIxsFSFrFUfwHb11JNBNcaZSp8yb%2FEhHW3suWRNZRzDGvxb0oifk5lmnX2V2J2dEJkX1Q0baZ1MvYXPXHvhAga7x9PTEyj8a%2BF%2BXbxiTn78bSQAAAABJRU5ErkJggg%3D%3D)](https://forum.omise.co)

`omise-php` is a library designed specifically to connect with Omise API written in PHP.

Please pop onto our [community forum](https://forum.omise.co) or contact [support@omise.co](mailto:support@omise.co) if you have any question regarding this library and the functionality it provides.

## Requirements

* PHP 5.3 and above.
* Built-in libcurl support.

## Installation

### Using Composer

You can install the library via [Composer](https://getcomposer.org/). If you don't already have Composer installed, first install it by following one of these instructions depends on your OS of choice:

* [Composer installation instruction for Windows](https://getcomposer.org/doc/00-intro.md#installation-windows)
* [Composer installation instruction for Mac OS X and Linux](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

1. After composer is installed, you can declare Omise-PHP as a project dependency by creating a `composer.json` at the root of your project directory with the following content:
    ```json
    {
      "require": {
        "omise/omise-php": "dev-master"
      }
    }
    ```

2. Then run the following command to install the Omise-PHP library:
    ```
    php composer.phar install
    ```

3. Once you run the `composer install` command, the Composer will generate a `vendor` folder at the same directory as `composer.json`.
    Now you can then add the following line to PHP script to load the library:

    ```php
    require_once dirname(__FILE__).'/vendor/autoload.php';
    ```

4. Now you are ready to start using the library, please see the [configuration](https://github.com/omise/omise-php#configuration) and [quick start](https://github.com/omise/omise-php#quick-start) sections below for usage examples.

### Manually

If you're not using Composer, you can also download [the latest version of Omise-PHP](https://github.com/omise/omise-php/archive/v2.9.0.zip).
Then, follows the instruction below to install **Omise-PHP** to the project.

1. Extract the library to your project.

2. Then, include the following line into your PHP file, 
    ```php
    require_once 'path-to-library/omise-php/lib/Omise.php';
    ```

3. Now you are ready to start using the library, please see the [configuration](https://github.com/omise/omise-php#configuration) and [quick start](https://github.com/omise/omise-php#quick-start) sections below for usage examples.

_However, using Composer is recommended as you can easily keep the library up-to-date._

## Configuration

### Config your public and secret keys

In order to make any request to Omise API through Omise-PHP library, you will need to config your public and secret key to the project.
Type the following code in any place before executing the library.

```php
define('OMISE_PUBLIC_KEY', 'pkey_can_find_at_omise_dashboard');
define('OMISE_SECRET_KEY', 'skey_can_find_at_omise_dashboard');
```

Note, you can get your public and secret keys at Omise Dashboard.

_As for reference, you can check our document at [https://www.omise.co/api-authentication](https://www.omise.co/api-authentication)._

### API version

> This parameter most uses specially for backward-compatible reason, it's not necessary to config when using the library.
> 
> **It is highly recommended to set this version to the current version you're using.**  
> **(or you can just skip this section, Omise will then use your current API version as an default in any requests).**

You can choose which API version to use with Omise. Each API version has new features and might not be compatible with previous versions. You can change the default version by visiting your Omise Dashboard.

To overwrite the API version to use, you can specify it by defining `OMISE_API_VERSION`.  
The version configured here will have **higher priority** than the version set in your Omise account.
This is useful if you have multiple environments with different API versions for testing.
(e.g. Development on the latest version but production is on an older version).

```php
define('OMISE_API_VERSION', '2014-07-27');
```

You can check your current API version at Omise Dashboard.

![screen shot 2560-03-21 at 4 46 07 pm](https://cloud.githubusercontent.com/assets/2154669/24141410/ef0faf46-0e55-11e7-8e25-26e2a6fc403b.png)

## Quick Start

The following code demonstrates how to make a charge with Omise-PHP library.

Now from the above sections, your code will looks similar like the below.

```php
require_once dirname(__FILE__).'/vendor/autoload.php';

define('OMISE_PUBLIC_KEY', 'pkey_test_54ot96fkr3i2op60cng');
define('OMISE_SECRET_KEY', 'skey_test_54ot96fkr3i2op60cng');
```

Now, let's add the below code to create a charge through the library.

```php
$charge = OmiseCharge::create(array(
    'amount'   => 100000,
    'currency' => 'THB',
    'card'     => 'tokn_test_4xs9408a642a1htto8z'
));
```

To see a real implementation code, you can check from the link below.
[https://github.com/omise/examples/tree/master/php](https://github.com/omise/examples/tree/master/php)

After this, you can check the complete documentation at [https://www.omise.co/docs](https://www.omise.co/docs). 

## Development and Testing

To run an automated test suite, make sure you already have a [PHPUnit](https://phpunit.de) in your local machine.
Then run the PHPUnit:

```shell
phpunit omise-php/tests
```

If you want to run with a specific test, let's try

```bash
phpunit omise-php/tests/omise/AccountTest
```

## License

Omise-PHP is open-sourced software released under the [MIT License](https://opensource.org/licenses/MIT).
