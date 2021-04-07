# CHANGELOG

### [v2.13.0 _(April 7, 2021)_](https://github.com/omise/omise-php/releases/tag/v2.13.0)

- Change installment minimum to 200000 subunits ([#132](https://github.com/omise/omise-php/pull/132))
- Add Receipt API ([#126](https://github.com/omise/omise-php/pull/126))
- Add Chain API ([#127](https://github.com/omise/omise-php/pull/127))
- Add expire method for Charge ([#130](https://github.com/omise/omise-php/pull/130))
- Add accept method for Dispute ([#125](https://github.com/omise/omise-php/pull/125))
- Add destroy method for Link ([#124](https://github.com/omise/omise-php/pull/124))
- Add update method for Account ([#123](https://github.com/omise/omise-php/pull/123))
- Add a `retrieve` method to OmiseSource ([#121](https://github.com/omise/omise-php/pull/121))

### [v2.12.0 _(July 31, 2020)_](https://github.com/omise/omise-php/releases/tag/v2.12.0)

- Removed certificate pinning (PR [#118](https://github.com/omise/omise-php/pull/118))

### [v2.11.2 _(May 8, 2019)_](https://github.com/omise/omise-php/releases/tag/v2.11.2)

#### 🚀 Enhancements

- Changes hacked instalment minimum to 300000 subunits. (PR [#113](https://github.com/omise/omise-php/pull/113))

#### 📝 Documents

- Removing Omise (demo) keys out from README document. (PR [#111](https://github.com/omise/omise-php/pull/111))

---

### [v2.11.1 _(Jan 16, 2019)_](https://github.com/omise/omise-php/releases/tag/v2.11.1)

#### 👾 Bug Fixes

- Fixes issue with use of array constant (mandated PHP 5.6+). (PR [#106](https://github.com/omise/omise-php/pull/106))

---

### [v2.11.0 _(Jan 9, 2019)_](https://github.com/omise/omise-php/releases/tag/v2.11.0)

#### ✨ Highlights

- Introducing Capability API. (PR [#100](https://github.com/omise/omise-php/pull/100))
- Officially dropping support of PHP v5.3. (PR [#101](https://github.com/omise/omise-php/pull/101))

---

### [v2.10.0 _(December 2, 2018)_](https://github.com/omise/omise-php/releases/tag/v2.10.0)

#### ✨ Highlights

- Refundable within charge class. (PR [#92](https://github.com/omise/omise-php/pull/92))

#### 🚀 Enhancements

- Be able to filter when retrieving a Refund List from a Charge object. (PR [#91](https://github.com/omise/omise-php/pull/91))
- OmiseCardList, relocate the card-fetching logic back to its parent class (OmiseCustomer). (PR [#90](https://github.com/omise/omise-php/pull/90))
- Apply PSR Code Styling Standard to the library. (PR [#89](https://github.com/omise/omise-php/pull/89))
- Add PHP Code Sniffer 3.x to the composer package. (PR [#88](https://github.com/omise/omise-php/pull/88))
- Update Composer Spec. (PR [#87](https://github.com/omise/omise-php/pull/87))
- Upgrade CircleCI to v2. (PR [#82](https://github.com/omise/omise-php/pull/82))
- Centralising all loaders into one file, `lib/Omise.php`. (PR [#81](https://github.com/omise/omise-php/pull/81))
- README.md: enhancing 'how-to' and other contents, make it clearer and easy to follow. (PR [#77](https://github.com/omise/omise-php/pull/77))

#### 👾 Bug Fixes

- Fix bug "authentication failed" when executing OmiseTransfer::search(). (PR [#94](https://github.com/omise/omise-php/pull/94))

---

### [v2.9.1 _(March 21, 2018)_](https://github.com/omise/omise-php/releases/tag/v2.9.1)

#### 🚀 Enhancements

- Be able to limit items that will be shown at the Search Object. (PR [#75](https://github.com/omise/omise-php/pull/75))

#### 👾 Bug Fixes

- Fix PHP v7.2 raise a warning message when execute OmiseApiResource::execute() with non-array assigned at the first argument. (PR [#71](https://github.com/omise/omise-php/pull/71), thanks @forfunza)

### [v2.9.0 _(November 6, 2017)_](https://github.com/omise/omise-php/releases/tag/v2.9.0)

#### ✨ Highlights

- Support Omise [Source API](https://www.omise.co/source-api). (PR [#68](https://github.com/omise/omise-php/pull/68))
- Link to Omise Forum instead of Gitter (deprecate Gitter channel). (PR [#67](https://github.com/omise/omise-php/pull/67))

For more information, please visit https://github.com/omise/omise-php/releases/tag/v2.9.0

---

### [v2.8.0 _(June 24, 2017)_](https://github.com/omise/omise-php/releases/tag/v2.8.0)

#### ✨ Highlights

- Support Omise [Forex API](https://www.omise.co/forex-api). (PR [#64](https://github.com/omise/omise-php/pull/64))
- Support Omise [Schedule APIs](https://www.omise.co/schedules-api). (PR [#63](https://github.com/omise/omise-php/pull/63))
- Support Omise [Search APIs](https://www.omise.co/search-api). (PR [#58](https://github.com/omise/omise-php/pull/58))

#### 🚀 Enhancements

- Provide exception classes for `invalid_link`, `failed_refund` and `bad_request` error code.  (PR [#61](https://github.com/omise/omise-php/pull/61))

For more information, please visit https://github.com/omise/omise-php/releases/tag/v2.8.0

---

### [v2.7.1 _(March 22, 2017)_](https://github.com/omise/omise-php/releases/tag/v2.7.1)

#### 👾 Bug Fixes

- Update library's version number.

For more information, please visit https://github.com/omise/omise-php/releases/tag/v2.7.1

---

### [v2.7.0 _(March 21, 2017)_](https://github.com/omise/omise-php/releases/tag/v2.7.0)

#### 🚀 Enhancements

- Correct the Docblock at OmiseApiResource::isDestroy() method. (PR [#57](https://github.com/omise/omise-php/pull/57))
- Include PHP Version to the `USER-AGENT` header when make a request to Omise API. (PR [#56](https://github.com/omise/omise-php/pull/56))

#### 👾 Bug Fixes

- Remove questionmark from fixture filename. (PR [#55](https://github.com/omise/omise-php/pull/55))
- Remove unreasonable conditional block from OmiseCustomer lib. (PR [#51](https://github.com/omise/omise-php/pull/51))

For more information, please visit https://github.com/omise/omise-php/releases/tag/v2.7.0

---

## [2.6.0] 2016-12-15
- [added] OmiseLink api is now available. (@turboza)
- [added] OmiseRecipient object be able to reload resource itself (@guzzilar)
- [added] OmiseEvent api is now available. (@guzzilar)
- [updated]  phpunit configuration file. (@oaattia)
- [updated] Revised code style to match with PSR-2 (http://www.php-fig.org/psr/psr-2) spec. (@guzzilar)
- [fixed] Autoload OmiseDispute class in lib/Omise.php file (@guzzilar)

For more information, please visit https://github.com/omise/omise-php/releases/tag/v2.6.0

## [2.5.0] 2016-07-01
- [Added] Add charge reverse method (@zentetsukenz)
- [Fixed] Change condition when matching phpunit from using fixed string to regex (@zentetsukenz)

## [2.4.1] 2015-12-03
- [Added] Add fetching options to customer cards (bde7986)

## [2.4.0] 2015-11-13
- [Added] Add Omise-Version header to request.
- [Added] Add `OMISE_USER_AGENT_SUFFIX` constant that let's people add the suffix into the `user-agent` string.

## [2.3.2] 2015-09-30
- [Fixed] Pass key values into the OmiseRefundList object when call a refunds() method inside the OmiseCharge instance.

## [2.3.1] 2015-07-29
- [Added] New DigiCert CA certificates.

## [2.3.0] 2015-06-24
- [Added] Implemented **Dispute** APIs (retrieve, reload, update)
- [Added] Added more Unit Test for **Dispute** APIs (7 tests, 20 assertions)

## [2.2.0] 2015-06-08
- [Added] Implemented **Recipient** APIs (retrieve, create, update, destroy, Recipient's error code handler class)
- [Changed] Changed `OMISE_PHP_LIB_VERSION` constant variable's value from **2.1.3** to **2.2.0** in *lib/omise/res/OmiseApiResource.php*.

## [2.1.3] 2015-06-02
- [Added] Added fixture files for mock some data to use it in various test case.
- [Added] Added **CHANGELOG.md** file.
- [Added] Added more test case.
- [Added] Created `TestConfig` class that extends `PHPUnit_Framework_TestCase` class
- [Improved] Enhance a unit test methodology. everytime when phpunit is execute (for run a test), it will look up a `json response` by request data from **local file system** rather than **connect to the real Omise server**.
- [Improved] Rewrote some function's comments for make it clear what it do.
- [Changed] In */lib/omise/res/obj/OmiseObject.php*, Changed `refresh` method access modifier from `protected` to `public`.
- [Changed] Changed all test class to extends `TestConfig` class rather than extend directly to `PHPUnit` class
- [Changed] Renamed some test methods to clarified what it will do.
- [Changed] Changed `OMISE_PHP_LIB_VERSION` constant variable's value from **2.1.2** to **2.1.3** in *lib/omise/res/OmiseApiResource.php*.
- [Removed] Removed some code that's needless for local file system test environment.
- [Removed] Removed setUp, tearDown method from all test.

## [2.1.2] 2015-02-04
- [Changed] Changed `OMISE_PHP_LIB_VERSION` constant variable's value from **2.0.0** to **2.1.2** in *lib/omise/res/OmiseApiResource.php*.
- [Removed] Removed version field in *composer.json*.
- [Removed] Removed `Global Namespace` in `OmiseObject`'s implement class *(lib/omise/res/obj/OmiseObject.php)*.

## [2.1.1] 2015-02-03
- [Fixed] Fixed the error for a case insensitive system, (renamed a capital letter to small letter in *lib/omise/res/OmiseApiResource.php*).

## [2.0.0] 2015-01-31
- [Added] Added *.gitignore* file.
- [Added] Added `OMISE_PHP_LIB_VERSION` and `OMISE_API_VERSION` constant into *lib/omise/res/OmiseApiResource.php*.
- [Added] Added `lib/omise/OmiseCardList` class.
- [Added] Added `lib/omise/OmiseRefund` class.
- [Added] Added `lib/omise/OmiseRefundList` class.
- [Added] Added *tests/omise* folder with *AccountTest*, *BalanceTest*, *CardTest*, *ChargeTest*, *CustomerTest*, *RefundTest*, *TestConfig*, *TokenTest*, *TransactionTest*, *TransferTest* (.php) and *testall.sh* test case files.
- [Added] Added `Global Namespace` in `OmiseObject`'s implement class *(lib/omise/res/obj/OmiseObject.php)*.
- [Added] Added `refunds` method in `lib/omise/OmiseCharge` class.
- [Improved] Improved README.md file's content, Added **Using Composer** and **Manually** section in **Installation** subject, Added **Usage** and **Testing** subject.
- [Improved] Improved a comment in various methods (edited some confuse word to proper word).
- [Changed] Changed php required from `PHP 5.0` to `PHP 5.3` in *README.md*
- [Changed] Changed version required field from  **1.0.1** to **2.1.0** in *composer.json*.
- [Changed] Changed php version required field from  **5.3.0** to **5.3.2** in *composer.json*.
- [Changed] Changed `Autoload Mapping` rule from `PSR-0` to `Classmap` in *composer.json*.
- [Changed] Added `g_` prefix to `retrieve`, `create`, `update`, `destroy`, `reload` method's name.
- [Changed] Renamed some **plural** class name to **singular**.
- [Changed] Renamed `getCards` method's name to `cards` and created new `getCards` method with new behaviour.
- [Changed] in *lib/omise/res/OmiseApiResource.php* file, use `call_user_func` function to access the `getInstance` method rather than access by use `Class::getInstance()` directly.
- [Changed] Removed `CURLOPT_FOLLOWLOCATION` and `CURLOPT_MAXREDIRS` options in `genOptions` method in *lib/omise/res/OmiseApiResource.php* file.
- [Removed] Removed `OMISE_PHP_LIB_VERSION` and `OMISE_API_VERSION` constant in *lib/Omise.php*.
- [Removed] Removed *lib/omise/res/obj/OmiseCardList.php* file.
- [Removed] Removed *lib/omise/res/obj/OmiseList.php* file.
- [Removed] Removed *lib_test* folder.

## [0.0.1] - 2014-12-02
- Initial version.
