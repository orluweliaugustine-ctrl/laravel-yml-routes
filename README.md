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
Output routes in the routes.php file

```php
\Broswilli\LaravelYmlRoutes\LaravelYmlRoutesFacade::createRoutes();
```
## Usage

Edit the root YAML file

```YAML
resource_1:
  file: example.yaml
  prefix: front
  middleware: ['auth', 'can:isAdmin', auth]
resource_2:
  file: example2.yaml
  prefix: admin,
  name: admin
  middleware: ['guest']
resource_3:
  path: /root-test
  controller: [Broswilli\LaravelYmlRoutes\Http\Controllers\SampleController, index]
  methods: ['get']
resource_4:
  path: /root-invoke
  controller: [Broswilli\LaravelYmlRoutes\Http\Controllers\InvokableController]
  methods: ['get']
```
From the YAML above the root nodes resource_1 and resource_2 points to other yaml files that describes a group of routes. The root nodes reesource_3 and resource_4 creates 2 new routes with url http://example.com/root-test and http://example.com/root-invoke. 

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
