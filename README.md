# Laravel YAML Routes

[![Latest Version on Packagist](https://img.shields.io/packagist/v/broswilli/laravel-yml-routes.svg?style=flat-square)](https://packagist.org/packages/broswilli/laravel-yml-routes)
[![Total Downloads](https://img.shields.io/packagist/dt/broswilli/laravel-yml-routes.svg?style=flat-square)](https://packagist.org/packages/broswilli/laravel-yml-routes)
![GitHub Actions](https://github.com/broswilli/laravel-yml-routes/actions/workflows/main.yml/badge.svg)

This package is created for Laravel Developers to create routes using YAML files. This package makes it easy for many routes to be created and arranged with well organized prefixes and middleware.

## Installation

You can install the package via composer:

```bash
composer require broswilli/laravel-yml-routes
```

You can publish configuration files

```bash
php artisan vendor:publish --tag laravel-yml-routes-config
```

Edit the Root YAML File:

```YAML
resource_1:
  file: admin.yaml
  prefix: admin
  middleware: ['can:isAdmin']
```
Create the admin.yaml file in the same directory

```YAML
admin_org:
  path: /org
  controller: [Adapt\SchAdmin\Http\Controllers\Administration\OrganizationController]
  methods: ['resource']
```

## Usage

```php
// Usage description here
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email broswilli@gmail.com instead of using the issue tracker.

## Credits

-   [Weli Orlu](https://github.com/broswilli)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
