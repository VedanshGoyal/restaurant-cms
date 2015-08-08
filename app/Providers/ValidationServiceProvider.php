<?php

namespace Restaurant\Providers;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('tags', function ($attribute, $value, $parameters) {
            if (!is_array($value)) {
                return false;
            }

            foreach ($value as $val) {
                if (!is_string($val)) {
                    return false;
                }
            }

            return true;
        });

        \Validator::extend('basicText', function ($attribute, $value, $parameters) {
            return preg_match('/^[\p{L}\p{P}\p{N}\s]+$/u', $value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
