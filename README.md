# Conveniently interact with the Open Banking Nigeria API with ease!
![run-tests](https://github.com/digikraaft/openbankingng-php/workflows/run-tests/badge.svg)
[![Build Status](https://travis-ci.com/digikraaft/openbankingng-php.svg?token=6YhB5FxJsF7ENdMM7Mzz&branch=master)](https://travis-ci.com/digikraaft/openbankingng-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/digikraaft/openbankingng-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/digikraaft/openbankingng-php/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/digikraaft/openbankingng-php/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

This package provides an expressive and convenient way to interact with the [Open Banking Nigeria API](https://openbanking.ng).

# IMPORTANT NOTICE
Please note that the Open Banking Nigeria API is still in development, this package
is a pre-lease and therefore not stable for production. Use at your discretion!

We will continue to update this package as new features are added to the Open Banking API.

## Installation

You can install the package via composer:

```bash
composer require digikraaft/openbankingng-php
```

## Usage
All APIs documented in Open Banking Nigeria's [API Reference](https://apis.openbanking.ng) 
are currently supported by this package.
Using the individual API follows a general convention so that it can be simple and predictable.
```
<?php 

{API_NAME}::{API_END_POINT}();

```
Before this, the API key needs to be set.
```
<?php 

include_once('vendor/autoload.php');


use Digikraaft\OpenBankingNg\OpenBankingNg;


OpenBankingNg::setApiKey('AS_TEST_1234abcd');

```
You can easily pass parameters to be sent as arguments to the `API_END_POINT` method like this:
```
<?php

include_once('vendor/autoload.php');


use Digikraaft\OpenBankingNg\OpenBankingNg;
use Digikraaft\OpenBankingNg\Account;


OpenBankingNg::setApiKey('AS_TEST_1234abcd');

$params = [
    'firstName' => 'John',
    'surname' => 'Doe',
    'email' => 'hello@digikraaft.ng',
];

$account = Account::openAccount($params);

```
This also applies to `POST` and `PUT` requests.

For endpoints that require path parameters like the `fetch customer accounts` with the request like `account/customer/{customerId}`,
simply pass in a string into the `API_END_POINT` like this:

```
<?php

include_once('vendor/autoload.php');


use Digikraaft\OpenBankingNg\OpenBankingNg;
use Digikraaft\OpenBankingNg\Account;


OpenBankingNg::setApiKey('AS_TEST_1234abcd');
$customerId = '1234567890';
$accounts = Account::list($customerId);

```

For `API_END_POINT`s that take both path and body parameters like the `update direct debit` with the `PUT` request `/directdebit/{{account}}/{{mandateId}}/`,
simply pass in a string as the first argument, an array as the second like this:

```
<?php
include_once('vendor/autoload.php');


use Digikraaft\OpenBankingNg\OpenBankingNg;
use Digikraaft\OpenBankingNg\DirectDebit;


OpenBankingNg::setApiKey('AS_TEST_1234abcd');

$account = '01234567890';

$mandateId = 'MAN1234567890';

$params = [
    'sourceAccount' => '01234567890',
    'merchantAccount' => '1234567890',
];


$directDebit = DirectDebit::update($account, $mandateId, $params);

```

There are a few exceptions to the `API_END_POINT` convention.

Check the wiki page [here](../../wiki) for detailed reference of the available methods

<br><br>
This package returns the exact response from the OpenBankingNg API but as the `stdClass` type 
such that responses can be accessed like this:

```
<?php

include_once('vendor/autoload.php');


use Digikraaft\OpenBankingNg\OpenBankingNg;
use Digikraaft\OpenBankingNg\Atm;


OpenBankingNg::setApiKey('AS_TEST_1234abcd');

$atms = Atm::list();

if($atms->status == '00') {
    foreach ($atms->data as $atm) {
        echo $atm->atmId . "<br>";
    }
}
```

## Documentation
We're working on a detailed documentation which will be updated soon.

## Todo
* Documentation
* More tests

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
