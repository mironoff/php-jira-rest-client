<?php

namespace mironoff\JiraRestApi;

use Illuminate\Support\ServiceProvider;
use mironoff\JiraRestApi\Configuration\ConfigurationInterface;
use mironoff\JiraRestApi\Configuration\DotEnvConfiguration;

class mironoff\JiraRestApiServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->bind(ConfigurationInterface::class, function () {
            return new DotEnvConfiguration(base_path());
        });
    }
}
