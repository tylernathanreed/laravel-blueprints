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
#### Step 2: Publish Configuration

This package comes with a configuration file. You can either publish the configuration file (using `php artisan vendor:publish`), or by copying the configuration file from the source code directly (see `~/config/blueprints.php`).

#### Step 3: Replace the Schema Facade

This package leverages the `Schema` facade to override the default blueprint resolver for the schema builder. While this is minimally invasive on Laravel's source code, it requires a small workaround to become functional in a project. The first quirk is that you'll have to replace Laravel's default `Schema` facade with the one provided by this package.

```php
// 'Schema' => Illuminate\Support\Facades\Schema::class,
'Schema' => Reedware\LaravelBlueprints\Schema::class,
```
