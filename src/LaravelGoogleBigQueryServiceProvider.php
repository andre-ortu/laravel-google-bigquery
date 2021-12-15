<?php

namespace AndreOrtu\LaravelGoogleBigQuery;

use Illuminate\Support\ServiceProvider;

class LaravelGoogleBigQueryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/google_bigquery.php' => config_path('google_bigquery.php'),
        ]);
    }
}
