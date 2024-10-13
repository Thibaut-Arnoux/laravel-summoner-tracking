<?php

namespace App\Providers;

use App\Services\Riot\RiotService;
use Illuminate\Support\ServiceProvider;

class RiotServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(RiotService::class, fn () => new RiotService);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
