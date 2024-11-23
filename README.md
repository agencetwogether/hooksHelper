# Filament Hooks helper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/agencetwogether/hookshelper.svg?style=flat-square)](https://packagist.org/packages/agencetwogether/hookshelper)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/agencetwogether/hookshelper/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/agencetwogether/hookshelper/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/agencetwogether/hookshelper/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/agencetwogether/hookshelper/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/agencetwogether/hookshelper.svg?style=flat-square)](https://packagist.org/packages/agencetwogether/hookshelper)

This plugin allows you to easily look ALL render hooks available in Filament on current page with a toggle.

## Table of contents

* [Installation](#installation)
* [Setup](#setup)
* [Usage](#usage)
    * [Placement](#placement)
    * [Icon](#icon)
    * [Minify toggle](#minify-toggle)

## Installation

You can install the package via composer:

```bash
composer require agencetwogether/hookshelper
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="hookshelper-config"
```

This is the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Render Hook
    |--------------------------------------------------------------------------
    | You may customize the render hook used to display the hooks visibility
    | toggle button. If null, this will be set to 'global-search.before'.
    | The 'panels::' prefix will be added automatically if omitted.
    |
    */
    'render_hook' => 'global-search.before',
    /*
    |--------------------------------------------------------------------------
    | Icon
    |--------------------------------------------------------------------------
    | You may select a different Heroicon to display for the hooks visibility
    | toggle button. If null, the default will be 'heroicon-m-cursor-arrow-rays'.
    |
    */
    'icon' => 'heroicon-m-cursor-arrow-rays',
    /*
    |--------------------------------------------------------------------------
    | Minify Button
    |--------------------------------------------------------------------------
    | Setting this to true will only display a small icon as a toggle button.
    | Otherwise, the button will display action label to perform.
    |
    */
    'tiny_toggle' => false,
];
```

You can publish the translations with:

```bash
php artisan vendor:publish --tag="hookshelper-translations"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="hookshelper-views"
```

## Setup

First, instantiate the plugin in your Panel's configuration:

```php
use Agencetwogether\HooksHelper\HooksHelperPlugin;

...

public function panel(Panel $panel) : Panel
{
    return $panel
        ->plugins([
            HooksHelperPlugin::make(),
        ]);
}
```

## Usage

The plugin will add a toggle button to your Filament Admin Panel, left to the global search bar.

Clicking it will trigger display all hooks available in current page otherwise hide them.

![image](https://raw.githubusercontent.com/agencetwogether/hooksHelper/main/assets/images/deactivated.jpg)

![image](https://raw.githubusercontent.com/agencetwogether/hooksHelper/main/assets/images/activated.jpg)

### Placement

The toggle button will be placed before the global search bar by default. If you want to change this, you can tweak the
`render_hook` key in the config file.

You can use any of the [render hooks](https://filamentphp.com/docs/3.x/support/render-hooks#available-render-hooks)
provided by Filament.

### Icon

The toggle button show an icon. If you want to change this, you can tweak the `icon` key in the config file.

### Minify toggle

You can only show icon in toggle. If you want to set this, you can tweak the `tiny_toggle` key in the config file.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Max](https://github.com/agencetwogether)
- [All Contributors](../../contributors)

## Thanks

- [PovilasKorop](https://github.com/povilaskorop) for idea

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
