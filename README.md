# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/strebl/inetworx-client.svg?style=flat-square)](https://packagist.org/packages/strebl/inetworx-client)
[![Build Status](https://img.shields.io/travis/strebl/inetworx-client/master.svg?style=flat-square)](https://travis-ci.org/strebl/inetworx-client)
[![StyleCI](https://styleci.io/repos/91091045/shield)](https://styleci.io/repos/91091045)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/4662f707-185d-476e-a110-0c34feb41169.svg?style=flat-square)](https://insight.sensiolabs.com/projects/4662f707-185d-476e-a110-0c34feb41169)
[![Quality Score](https://img.shields.io/scrutinizer/g/strebl/inetworx-client.svg?style=flat-square)](https://scrutinizer-ci.com/g/strebl/inetworx-client)
[![Total Downloads](https://img.shields.io/packagist/dt/strebl/inetworx-client.svg?style=flat-square)](https://packagist.org/packages/strebl/inetworx-client)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require strebl/inetworx-client
```


## Laravel

If you are using Laravel, you can register the service provider:

```php
'providers' => [
    // ...
    Strebl\Inetworx\InetworxServiceProvider::class,
];
```

To publish the config file to `config/inetworx.php` run (optional):

```bash
php artisan vendor:publish --provider="Strebl\Inetworx\InetworxServiceProvider"
```

If you are using Laravel, you can register the service provider:

```php
'aliases' => [
    // ...
    'Inetworx' => Strebl\Inetworx\InetworxFacade::class,
];
```

Set the environment variables with the correct values:

```
INETWORX_AUTH_HEADER_USERNAME=null
INETWORX_AUTH_HEADER_PASSWORD=null

INETWORX_API_USERNAME=null
INETWORX_API_PASSWORD=null
```



## Usage

### With Laravel

``` php
$skeleton = app(Strebl\Inetworx::class);
$sms->send($phoneNumber, 'Hello, Manuel!', $senderPhoneNumber);
```

Or you can use the Facade:

``` php
\Inetworx::send($phoneNumber, 'Hello, Manuel!', $senderPhoneNumber);
```

### Without Laravel

``` php
$sms = new Strebl\Inetworx(
    $authHeaderUsername,
    $authHeaderPassword,
    $apiUsername,
    $apiPassword,
);
$sms->send($phoneNumber, 'Hello, Manuel!', $senderPhoneNumber);
```

### Send a SMS

``` php
$sms->send($to, $message, $from);
```

### Get the remaining SMS credits

``` php
$sms->credit();
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email manuel@strebel.xyz instead of using the issue tracker.

## Credits

- [Manuel Strebel](https://github.com/strebl)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
