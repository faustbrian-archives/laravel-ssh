# Laravel Secure Shell

[![Latest Version](https://badgen.net/packagist/v/kodekeep/laravel-ssh)](https://packagist.org/packages/kodekeep/laravel-ssh)
[![Software License](https://badgen.net/packagist/license/kodekeep/laravel-ssh)](https://packagist.org/packages/kodekeep/laravel-ssh)
[![Build Status](https://img.shields.io/github/workflow/status/kodekeep/laravel-ssh/run-tests?label=tests)](https://github.com/kodekeep/laravel-ssh/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Coverage Status](https://badgen.net/codeclimate/coverage/kodekeep/laravel-ssh)](https://codeclimate.com/github/kodekeep/laravel-ssh)
[![Quality Score](https://badgen.net/codeclimate/maintainability/kodekeep/laravel-ssh)](https://codeclimate.com/github/kodekeep/laravel-ssh)
[![Total Downloads](https://badgen.net/packagist/dt/kodekeep/laravel-ssh)](https://packagist.org/packages/kodekeep/laravel-ssh)

This package was created by, and is maintained by [Brian Faust](https://github.com/faustbrian), and provides SSH, SCP and RSync capabilities for Laravel.

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

## Support Us

We invest a lot of resources into creating and maintaining our packages. You can support us and the development through [GitHub Sponsors](https://github.com/sponsors/faustbrian).

## License

Laravel Secure Shell is an open-sourced software licensed under the [MPL-2.0](LICENSE.md).
