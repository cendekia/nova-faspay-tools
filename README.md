
# A tool to provide an UI access of [Faspay](https://faspay.co.id) web services

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cendekia/nova-faspay-tools.svg?style=flat-square)](https://packagist.org/packages/cendekia/nova-faspay-tools)
![CircleCI branch](https://img.shields.io/circleci/project/github/cendekia/nova-faspay-tools/master.svg?style=flat-square)
[![Build Status](https://img.shields.io/travis/cendekia/nova-faspay-tools/master.svg?style=flat-square)](https://travis-ci.org/cendekia/nova-faspay-tools)
[![Quality Score](https://img.shields.io/scrutinizer/g/cendekia/nova-faspay-tools.svg?style=flat-square)](https://scrutinizer-ci.com/g/cendekia/nova-faspay-tools)
[![Total Downloads](https://img.shields.io/packagist/dt/cendekia/nova-faspay-tools.svg?style=flat-square)](https://packagist.org/packages/cendekia/nova-faspay-tools)

![Screenshot](https://i.imgur.com/GlTsvyJ.png)

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require cendekia/nova-faspay-tools
```

Next up, you must register the tool with Nova. This is typically done in the `tools` method of the `NovaServiceProvider`.

```php
// in app/Providers/NovaServiceProvider.php

// ...

public function tools()
{
    return [
        // ...
        new \Cendekia\FaspayTools\FaspayTools,
    ];
}
```


## Todo :

- [x] Recurring member check
- [ ] Update recurring member data
- [ ] TBA


## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email me@cendekiapp.com instead of using the issue tracker.

## Support

Buy me a cup of ☕ americano on the rocks. [Patreon](https://www.patreon.com/cendekia)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
