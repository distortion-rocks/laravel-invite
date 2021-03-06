# Laravel Invitations [WIP]

[![Latest Version on Packagist](https://img.shields.io/packagist/v/distortion/laravel-invite.svg?style=flat-square)](https://packagist.org/packages/distortion/laravel-invite)
[![Build Status](https://github.com/distortion-rocks/laravel-invite/actions/workflows/tests.yml/badge.svg)](https://github.com/distortion-rocks/laravel-invite/actions/workflows/tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/distortion/laravel-invite.svg?style=flat-square)](https://packagist.org/packages/distortion/laravel-invite)

Laravel invite provides a clean and simple library to add invitations to any Laravel Application.

## Installation

You can install the package via composer:

```bash
# Still in progress
```

## Usage

### Create a new invite
``` php
$user = Auth::user()

use Distortion\LaravelInvite\Facades\Invite;

/**
 * Will create & save a new invite and return the invite code for use later.
 * @return string code 
 */
$code = Invite::invite('invite@example.com', $user->id);

/**
 * Creates an invite with a custom expiration date/time
 * @return string code 
 */
$code = Invite::invite('invite@example.com', $user->id, '2021-04-11 12:22:11');
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please open a new github issue and provide a detailed outline of the problem you are facing.

## Credits

- [Vaugen Wakeling](https://github.com/vaugenwake)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
