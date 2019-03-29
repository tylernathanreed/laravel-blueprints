## Laravel Blueprints
Adds useful methods to the blueprint schema builder.

### Installation

#### Step 1: Require this Package

Require this package with composer.

```shell
composer require reedware/laravel-blueprints
```

This package uses auto-discovery, so it doesn't require you to manually add the service provider for Laravel 5.5+. Should you choose to register the service provider manually, or you're using a framework older than Laravel 5.5, you can include the following class in your list of service providers:

```php
\Reedware\LaravelBlueprints\BlueprintsServiceProvider::class
```
