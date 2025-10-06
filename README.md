# Laravel YAML Routes

[![Latest Version on Packagist](https://img.shields.io/packagist/v/broswilli/laravel-yml-routes.svg?style=flat-square)](https://packagist.org/packages/broswilli/laravel-yml-routes)
[![Total Downloads](https://img.shields.io/packagist/dt/broswilli/laravel-yml-routes.svg?style=flat-square)](https://packagist.org/packages/broswilli/laravel-yml-routes)


This package is created for Laravel Developers to create routes using YAML files. This package makes it easy for many routes to be created and arranged with well organized prefixes and middleware.

## Installation

You can install the package via composer:

```bash
composer require orluweliaugustine-ctrl/laravel-yml-routes
```

#### You can publish configuration files

```bash
php artisan vendor:publish --tag laravel-yml-routes-config
```

#### Edit the Root YAML File:

```yaml
resource_1:
  file: admin.yaml
  prefix: admin
  middleware: ['can:isAdmin']
```
Create a yaml file of choice for the sake of this example create admin.yaml file in the same directory as the root.yaml file

```yaml
admin_org:
  path: /org
  controller: [Adapt\SchAdmin\Http\Controllers\Administration\OrganizationController]
  methods: ['resource']
```
#### Output routes in the routes.php file

```php
\Orluweliaugustine-ctrl\LaravelYmlRoutes\LaravelYmlRoutesFacade::createRoutes();
```
## Usage

#### Edit the root YAML file

```yaml
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
  controller: [Adapt\SchAdmin\Http\Controllers\SampleController, index]
  methods: ['get']
resource_4:
  path: /root-invoke
  controller: [Adapt\SchAdmin\Http\Controllers\InvokableController]
  methods: ['get']
```
From the YAML above the root nodes resource_1 and resource_2 points to other yaml files that describes a group of routes. The root nodes resource_3 and resource_4 creates 2 new routes with url example.com/root-test and example.com/root-invoke. 

example.yaml

```yaml
test_resource:
  path: /test
  controller: [Adapt\SchAdmin\Http\Controllers\SampleController, index]
  methods: ['get']
test_resource_2:
  path: /resc
  controller: [Adapt\SchAdmin\Http\Controllers\ResourceController]
  methods: ['resource']
test_resource_3:
  path: /api
  controller: [Adapt\SchAdmin\Http\Controllers\ResourceController]
  methods: ['apiResource']
test_invokable:
  path: /invoke
  controller: [Adapt\SchAdmin\Http\Controllers\InvokableController]
  methods: ['get']
```
All urls from example.yaml will have a prefix of front and a common middleware of 'can:isAdmin' applied:
- example.com/front/test
- example.com/front/invoke

The front prefix and the middleware was defined in the root.yaml file

#### Route Names and Methods
- test_resource
  - Route Name(s): test_resource
  - Method(s): GET
  - Controller Class: Adapt\SchAdmin\Http\Controllers\SampleController
  - Action: index
- test_resource_2
  - Route Names(s): resc.index, resc.store, resc.create, resc.show, resc.edit, resc.update, resc.destroy
  - Methods: GET, POST, PUT, DELETE
  - Controller Class: Adapt\SchAdmin\Http\Controllers\ResourceController
- test_resource_3: This is similar to test_resource_2 suitable for restful API's. It comes without routes for the create, and edit actions which are not needed for restfull API's
- test_invokable: A controller that has the __invoke method or a single action controller. You can create the route without stating the action
    
Please visit https://laravel.com/docs/11.x/controllers#resource-controllers to know more about resource controllers. 

Visit https://laravel.com/docs/11.x/controllers#api-resource-routes to know more about API Resource.  

Visit https://laravel.com/docs/11.x/controllers#single-action-controllers to know more about single action controllers

#### Route Prefixes
The example2.yaml is used to demonstrate route prefixes. In the root.yaml file it was referenced as follows:
```yaml
resource_2:
  file: example2.yaml
  prefix: admin,
  name: admin
  middleware: ['guest']
```
example2.yaml

```yaml
admin-index:
  path: /
  controller: [Adapt\SchAdmin\Http\Controllers\AdminController, index]
  methods: ['get']
```
The root.yaml file where the example2 routes were defined has a node with a key of name. The function of the name node is to create route name prefix.
- admin-index
  - Route Name(s): admin.admin-index
  - Method(s): GET
  - Controller Class: Adapt\SchAdmin\Http\Controllers\AdminController
  - Action: index

Notice that the Route Name is admin.admin-index instead of admin-index because of the name node defined in the root.yaml file

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

-   [Weli Orlu](https://github.com/orluweliaugustine-ctrl)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
