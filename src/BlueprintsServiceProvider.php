<?php

namespace Reedware\LaravelBlueprints;

use Illuminate\Support\ServiceProvider;

class BlueprintsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the Configuration File
        $this->publishConfigurationFile();
    }

    /**
     * Publishes the Configuration File.
     *
     * @return void
     */
    protected function publishConfigurationFile()
    {
        // Determine the Local Configuration Path
        $source = $this->getLocalConfigurationPath();

        // Determine the Application Configuration Path
        $destination = $this->getApplicationConfigPath();

        // Publish the Configuration File
        $this->publishes([$source => $destination], 'config');
    }

    /**
     * Returns the Path to the Configuration File within this Package.
     *
     * @return string
     */
    protected function getLocalConfigurationPath()
    {
        return __DIR__ . '/../config/blueprints.php';
    }

    /**
     * Returns the Path to the Configuration File within the Application.
     *
     * @return string
     */
    protected function getApplicationConfigPath()
    {
        return config_path('blueprints.php');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            //
        ];
    }
}
