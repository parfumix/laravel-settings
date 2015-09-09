<?php

namespace Laravel\Settings;

use Illuminate\Support\ServiceProvider;
use Flysap\Support;

class SettingsServiceProvider extends ServiceProvider {

    /**
     * Publish resources.
     */
    public function boot() {
        $this->publishes([
            __DIR__.'/../assets/configuration' => config_path('yaml/settings'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->loadConfiguration();

        Support\merge_yaml_config_from(
            config_path('yaml/settings/general.yaml') , 'laravel-settings'
        );

        $this->app->singleton('settings-manager', function() {
            return new DriverManager(
                config('laravel-settings')
            );
        });
    }

    /**
     * Load configuration .
     *
     * @return $this
     */
    protected function loadConfiguration() {
        Support\set_config_from_yaml(
            __DIR__ . '/../configuration/general.yaml' , 'laravel-settings'
        );

        return $this;
    }
}