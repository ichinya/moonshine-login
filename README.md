# Form login for MoonShine

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ichinya/moonshine-login.svg?style=flat-square)](https://packagist.org/packages/ichinya/moonshine-login)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ichinya/moonshine-login/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ichinya/moonshine-login/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ichinya/moonshine-login/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ichinya/moonshine-login/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ichinya/moonshine-login.svg?style=flat-square)](https://packagist.org/packages/ichinya/moonshine-login)

This package provides a form login for the MoonShine admin panel.

## Installation

You can install the package via composer:

```bash
composer require ichinya/moonshine-login
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="moonshine-login-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="moonshine-login-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="moonshine-login-views"
```

## Usage

```php
$moonshineLogin = new Ichinya\MoonshineLogin();
echo $moonshineLogin->echoPhrase('Hello, Ichinya!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ichi](https://github.com/Ichinya)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
