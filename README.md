# Laravel Secure Shell

[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/kodekeep/laravel-ssh/run-tests?label=tests)](https://github.com/kodekeep/laravel-ssh/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Code Coverage](https://badgen.net/codecov/c/github/kodekeep/laravel-ssh)](https://codecov.io/gh/kodekeep/laravel-ssh)
[![Minimum PHP Version](https://badgen.net/packagist/php/kodekeep/laravel-ssh)](https://packagist.org/packages/kodekeep/laravel-ssh)
[![Latest Version](https://badgen.net/packagist/v/kodekeep/laravel-ssh)](https://packagist.org/packages/kodekeep/laravel-ssh)
[![Total Downloads](https://badgen.net/packagist/dt/kodekeep/laravel-ssh)](https://packagist.org/packages/kodekeep/laravel-ssh)
[![License](https://badgen.net/packagist/license/kodekeep/laravel-ssh)](https://packagist.org/packages/kodekeep/laravel-ssh)

> SSH/SCP Utilities for Laravel.

## Installation

```bash
composer require kodekeep/laravel-ssh
```

## Usage

``` php
$shell = new SecureShell('user', '127.0.0.1');

$shell->execute('whoami');

$shell->upload('/home/root/source', '/home/root/target');

$shell->download('/home/root/source', '/home/root/target');
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover a security vulnerability within this package, please send an e-mail to hello@kodekeep.com. All security vulnerabilities will be promptly addressed.

## Credits

This project exists thanks to all the people who [contribute](../../contributors).

## License

Mozilla Public License Version 2.0 (MPL-2.0). Please see [License File](LICENSE.md) for more information.
