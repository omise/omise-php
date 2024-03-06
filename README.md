# Omise PHP Library

`omise-php` is a PHP library designed specifically to connect with the Opn Payments API.

## Security Warning

**Please do NOT use Omise PHP library versions less than 2.12.0, as they are outdated and have security vulnerabilities.**


## Requirements

* PHP v7.4 and higher.
* Built-in [libcurl](http://php.net/manual/en/book.curl.php) support.

> Note: Due to the PHP [END OF LIFE](http://php.net/supported-versions.php) cycle, we encourage you to run the Omise-PHP library on PHP version 7.4 or higher as there is no longer security support for any PHP version lower than 7.4. Lack of support could cause security vulnerabilities.

## Installation

### Using Composer

You can install the library via [Composer](https://getcomposer.org/). If you don't already have Composer installed, first install it by following one of these instructions, depending on your OS:

* [Composer installation instruction for Windows](https://getcomposer.org/doc/00-intro.md#installation-windows)
* [Composer installation instruction for Mac OS X and Linux](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

1. After Composer is installed, you can declare Omise-PHP as a project dependency by creating a `composer.json` file at the root of your project directory, with the following content:
   
    ```json
    {
      "require": {
        "omise/omise-php": "dev-master"
      }
    }
    ```

2. Run the following command to install the Omise-PHP library:
    ```
    php composer.phar install
    ```

3. Once you run the `composer install` command, the Composer will generate a `vendor` folder in the same directory as `composer.json`.
   
   Add the following line to the PHP script to load the library:

    ```php
    require_once dirname(__FILE__).'/vendor/autoload.php';
    ```

4. You are ready to start using the library. View the [configuration](https://github.com/omise/omise-php#configuration) and [quick start](https://github.com/omise/omise-php#quick-start) sections for usage examples.

### Manually

If you are not using Composer, you can download [the latest version of Omise-PHP](https://github.com/omise/omise-php/archive/v2.11.2.zip).
Then, follow the instructions to install **Omise-PHP** to the project.

1. Extract the library to your project.

2. Include the following line in your PHP file:
   
    ```php
    require_once 'path-to-library/omise-php/lib/Omise.php';
    ```

3. You are ready to start using the library. View the [configuration](https://github.com/omise/omise-php#configuration) and [quick start](https://github.com/omise/omise-php#quick-start) sections for usage examples.

_Using Composer is recommended as you can easily keep the library up-to-date._

## Configuration

### • Configure your public and secret keys

Before you make the first request to the Opn Payments API, you will need to configure your **public key** and **secret key** (these can be found on the [Opn Payments Dashboard](https://dashboard.omise.co). Log in, then go to **Keys** from the sidebar menu).

![configuring omise-php, public and secret keys](https://user-images.githubusercontent.com/2154669/54261954-9eed9e00-459f-11e9-96b1-747061640fab.png)

Place the following code next to the line where Omise-PHP library is loaded.

```php
define('OMISE_PUBLIC_KEY', 'pkey_test_***');
define('OMISE_SECRET_KEY', 'skey_test_***');
```


_Reference: [API Authentication](https://docs.opn.ooo/api-authentication)._

ー

### • API version

To enforce the API version that the application must use, define `OMISE_API_VERSION`.  
The version specified by this settings will override the version setting in your account. This is useful if you have multiple environments with different API versions (e.g. development on the latest but production on the older version).

```php
define('OMISE_API_VERSION', '2017-11-02');
```

API version can be found on the [Opn Payments Dashboard](https://dashboard.omise.co). Log in, then go to **API versions** from the top-right menu.

![configuring omise-php, API version](https://cloud.githubusercontent.com/assets/2154669/24141410/ef0faf46-0e55-11e7-8e25-26e2a6fc403b.png)

> It is highly recommended to set `OMISE_API_VERSION` to the current version that you are using to prevent any issues that might arise from accidentally clicking `update Omise-API version` on the dashboard.

## Quick start

From the preceding sections, your code will look similar to the following code:

```php
<?php
require_once dirname(__FILE__).'/vendor/autoload.php';

define('OMISE_PUBLIC_KEY', 'pkey_test_***');
define('OMISE_SECRET_KEY', 'skey_test_***');
define('OMISE_API_VERSION', '2017-11-02');
```

Now, let's add the the code to retrieve your account information:

```php
$account = OmiseAccount::retrieve();

echo $account['email']; // your email will be printed on a screen.
```

And that's it! You have just made a request to the Opn Payments API, easy huh?

Feel free to integrate the Opn Payment Gateway service as you desire to make it fit with your business flow.  
Also, read the [documents](https://docs.opn.ooo/) and view the [example code](https://github.com/omise/examples/tree/master/php) to get more information if you need help.

Have fun!

## Development and testing

To run an automated test suite, make sure you already have a [PHPUnit](https://phpunit.de) in your local machine.
Then run the PHPUnit:

```ssh
cp .env.example .env
make test
```
- To generate a code coverage test report, run `make coverage`.

## Contributing

Thanks for your interest in contributing to Omise PHP. We are looking forward to hearing your thoughts and are willing to review your changes.

The following sections are instructions for contributors who consider submitting changes and/or issues.

### Submit the changes

You're all welcome to submit [pull requests](https://github.com/omise/omise-php/pulls).

Learn more about submitting a [pull request](https://help.github.com/articles/about-pull-requests).

### Submit the issue

Submit the issue through [GitHub's issue channel](https://github.com/omise/omise-php/issues).

Learn more about submitting an [issue](https://guides.github.com/features/issues).

## License

Omise-PHP is open-source software released under the [MIT License](https://opensource.org/licenses/MIT).
