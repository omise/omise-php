<?php

namespace Omise;

use Illuminate\Support\ServiceProvider;

class OmiseServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        define('OMISE_PUBLIC_KEY', env('OMISE_PUBLIC_KEY'));
        define('OMISE_SECRET_KEY', env('OMISE_SECRET_KEY'));
    }
}