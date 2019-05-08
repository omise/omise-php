# Omise PHP Client

[![](https://img.shields.io/badge/discourse-forum-1a53f0.svg?style=flat-square&logo=data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAOCAYAAAAfSC3RAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAVlpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IlhNUCBDb3JlIDUuNC4wIj4KICAgPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICAgICAgPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIKICAgICAgICAgICAgeG1sbnM6dGlmZj0iaHR0cDovL25zLmFkb2JlLmNvbS90aWZmLzEuMC8iPgogICAgICAgICA8dGlmZjpPcmllbnRhdGlvbj4xPC90aWZmOk9yaWVudGF0aW9uPgogICAgICA8L3JkZjpEZXNjcmlwdGlvbj4KICAgPC9yZGY6UkRGPgo8L3g6eG1wbWV0YT4KTMInWQAAAqlJREFUKBU9UVtLVFEU%2FvY%2B27mPtxl1dG7HbNRx0rwgFhJBPohBL9JTZfRQ0YO9RU%2FVL6iHCIKelaCXqIewl4gEBbEyxSGxzKkR8TbemmbmnDlzVvsYtOHbey1Y317fWh8DwCVMCfSHww3ElCs7CjuzbOcNIaEo9SbtlDRjZiNPY%2BvrqSWrTh7l3yPvrmh0KBZW59HcREjEqcGpElAuESRxopU648dTwfrIyH%2BCFXSH1cFgJLqHlma6443SG0CfqYY2NZjQnkV8eiMgP6ijjnizHglErlocdl5VA0mT3v102dseL2W14cYM99%2B9XGY%2FlQArd8Mo6JhbSJUePHytvf2UdnW0qen93cKQ4nWXX1%2FyOkZufsuZN0L7PPzkthDDZ4FQLajSA6XWR8HWIK861sCfj68ggGwl83mzfMclBmAQ%2BktrqBu9wOhcD%2BB0ErSiFFyEkdcYhKD27mal9%2F5FY36b4BB%2FTvO8XdQhlUe11F3WG2fc7QLlC8wai3MGGQCGDkcZQyymCqAPSmati3s45ygWseeqADwuWS%2F3wGS5hClDMMstxvJFHQuGU26yHsY6iHtL0sIaOyZzB9hZz0hHZW71kySSl6LIJlSgj5s5LO6VG53aFgpOfOFCyoFmYsOS5HZIaxVwKYsLSbJJn2kfU%2BlNdms5WMLqQRklX0FX26eFRnKYwzX0XRsgR0uUrWxplM7oqPIq8r8cZrdLNLqaABayxZMTTx2HVfglbP4xkcvqZEMNfmglevRi1ny5mGfJfTuQiBEq%2FMBvG0NqDh2TY47sbtJAuO%2Fe9%2Fn3STRFosm2WIxsFSFrFUfwHb11JNBNcaZSp8yb%2FEhHW3suWRNZRzDGvxb0oifk5lmnX2V2J2dEJkX1Q0baZ1MvYXPXHvhAga7x9PTEyj8a%2BF%2BXbxiTn78bSQAAAABJRU5ErkJggg%3D%3D)](https://forum.omise.co)

`omise-php` is a library designed specifically to connect with Omise API written in PHP.

Please pop onto our [community forum](https://forum.omise.co) or contact [support@omise.co](mailto:support@omise.co) if you have any question regarding this library and the functionality it provides.

## Requirements

* PHP v5.4 and above.
* Built-in [libcurl](http://php.net/manual/en/book.curl.php) support.

> Note that, due to the PHP [END OF LIFE](http://php.net/supported-versions.php) cycle, we encourage you to run Omise-PHP library on a PHP version 5.6 or higher as there is no longer security support for any below 5.6 and that could cause you any security vulnerable issues in the future.

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

If you're not using Composer, you can also download [the latest version of Omise-PHP](https://github.com/omise/omise-php/archive/v2.11.2.zip).
Then, follows the instruction below to install **Omise-PHP** to the project.

1. Extract the library to your project.

2. Then, include the following line into your PHP file, 
    ```php
    require_once 'path-to-library/omise-php/lib/Omise.php';
    ```

3. Now you are ready to start using the library, please see the [configuration](https://github.com/omise/omise-php#configuration) and [quick start](https://github.com/omise/omise-php#quick-start) sections below for usage examples.

_However, using Composer is recommended as you can easily keep the library up-to-date._

## Configuration

### • Config your public and secret keys

First thing first, before you make a very first request to Omise API, you will need to configure your **public key** and **secret key** (these can be found at the [Omise Dashboard](https://dashboard.omise.co). Log in then go to **Keys** from the sidebar menu).

Place the following code next to a line where Omise-PHP library is loaded.

```php
define('OMISE_PUBLIC_KEY', 'pkey_test_***');
define('OMISE_SECRET_KEY', 'skey_test_***');
```

![configuring omise-php, public and secret keys](https://user-images.githubusercontent.com/2154669/54261954-9eed9e00-459f-11e9-96b1-747061640fab.png)

_Reference: [https://www.omise.co/api-authentication](https://www.omise.co/api-authentication)._

ー

### • API version

In case you want to enforce API version the application use, you can specify it by defining the `OMISE_API_VERSION`.  
The version specified by this settings will override the version setting in your account. This is useful if you have multiple environments with different API versions (e.g. development on the latest but production on the older version).

```php
define('OMISE_API_VERSION', '2017-11-02');
```

_API version can be found at [Omise Dashboard](https://dashboard.omise.co). Log in then go to **API versions** from the top-right menu._

![configuring omise-php, API version](https://cloud.githubusercontent.com/assets/2154669/24141410/ef0faf46-0e55-11e7-8e25-26e2a6fc403b.png)

> It is highly recommended to set `OMISE_API_VERSION` to the current version that you're using to prevent any trouble from accidentally click update Omise-API version at the dashboard.

## Quick Start

From the above sections, your code will look similar like the following code:

```php
<?php
require_once dirname(__FILE__).'/vendor/autoload.php';

define('OMISE_PUBLIC_KEY', 'pkey_test_***');
define('OMISE_SECRET_KEY', 'skey_test_***');
define('OMISE_API_VERSION', '2017-11-02');
```

Now, let's add the below code to retrieve your account information:

```php
$account = OmiseAccount::retrieve();

echo $account['email']; // your email will be printed on a screen.
```

And that's it! You have just made a request to Omise API, easy huh?

Now you are free from our instruction :D  
Feel free to integrate Omise Payment Gateway service anyway you like to make it fit with your business flow.  
Also, stop by [documents](https://www.omise.co/docs) or [example code](https://github.com/omise/examples/tree/master/php) sometime to get more informations if you need any helps.

Have fun!

## Development and Testing

To run an automated test suite, make sure you already have a [PHPUnit](https://phpunit.de) in your local machine.
Then run the PHPUnit:

```ssh
phpunit omise-php/tests
```

## Contributing

Thanks for your interest in contributing to Omise PHP. We're looking forward to hearing your thoughts and willing to review your changes.

The following subjects are instructions for contributors who consider to submit changes and/or issues.

### Submit the changes

You're all welcome to submit a pull request.
Please consider the [pull request template](https://github.com/omise/omise-php/blob/master/.github/PULL_REQUEST_TEMPLATE.md) and fill the form when you submit a new pull request.

Learn more about submitting pull request here: [https://help.github.com/articles/about-pull-requests](https://help.github.com/articles/about-pull-requests)

### Submit the issue

Submit the issue through [GitHub's issue channel](https://github.com/omise/omise-php/issues).

Learn more about submitting an issue here: [https://guides.github.com/features/issues](https://guides.github.com/features/issues)

## License

Omise-PHP is open-sourced software released under the [MIT License](https://opensource.org/licenses/MIT).
