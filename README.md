# Convenient PHP wrapper to the Mono API
![run-tests](https://github.com/digikraaft/mono-php/workflows/run-tests/badge.svg)
[![Build Status](https://travis-ci.com/digikraaft/mono-php.svg?token=6YhB5FxJsF7ENdMM7Mzz&branch=master)](https://travis-ci.com/digikraaft/mono-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/digikraaft/mono-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/digikraaft/mono-php/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/digikraaft/mono-php/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

This package provides an expressive and convenient way to interact with the [Mono API](https://withmono.com/).

# IMPORTANT NOTICE
Please note that the Mono API is not currently in private beta, this package
is a pre-lease and therefore may not be stable enough for production. Use at your discretion!

We will continue to update this package as new features are being added to the Mono API.

## Installation

You can install the package via composer:

```bash
composer require digikraaft/mono-php
```

## Usage
All APIs documented in Mono's [API Reference](https://docs.mono.co/docs) are currently supported by this package.

### Authentication
Before using any of the endpoints, you will have to authenticate the current account
with the endpoint `account/auth` :
```php
<?php 

include_once('vendor/autoload.php');


use Digikraaft\Mono\Mono;


Mono::setSecretKey('TEST_1234abcd');

$codeFromMonoConnect = "5eadinitaewqwuis";

$account = Account::authenticate($codeFromMonoConnect);

$accountId = $account->data->id;

```

### Available Methods
A list of the available methods are documented below:
#### Account
* `authenticate(string $codeFromConnect) : Array|Object`
* `bvnLookup($params = null) : Array|Object`
* `details(string $accountId) : Array|Object`
* `fetchStatement(string $accountId, array $filters) : Array|Object`
* `identity(string $accountId) : Array|Object`
* `income(string $accountId) : Array|Object`
* `listTransactions(string $accountId, array $filters) : Array|Object`
* `pollStatementPdfStatus(string $accountId, string $jobId) : Array|Object`
* `reAuthorise(string $accountId, ?array $params = null) : Array|Object`
* `sync(string $accountId, ?array $params = null) : Array|Object`
* `unlink(string $accountId, ?array $params = null) : Array|Object`

#### Mono
* `getSecretKey(): string`
* `setSecretKey(string $secretKey)`
* `coverage() : Array|Object`

#### Payment
* `initiate(array $params) : Array|Object`
* `onetimeDebitStatus(string $paymentId) : Array|Object`
* `recurringDebitStatus(string $paymentId) : Array|Object`

#### Plan
* `create(array $params) : Array|Object`
* `delete(string $paymentId) : Array|Object`
* `list(string $paymentId) : Array|Object`
* `update(string $paymentId, array $params) : Array|Object`

#### Wallet
* `balance() : Array|Object`

This package returns the exact response from the Mono API but as the `stdClass` type.

## Testing

``` bash
composer test
```

## More Good Stuff
Check [here](https://github.com/digikraaft) for more awesome free stuff!

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing
Contributions are welcome! Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security
If you discover any security related issues, please email hello@digikraaft.ng instead of using the issue tracker.

## Credits

- [Tim Oladoyinbo](https://github.com/timoladoyinbo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
