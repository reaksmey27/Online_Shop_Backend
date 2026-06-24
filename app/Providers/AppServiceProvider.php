<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Prevent N+1 by enabling strict mode in non-production (dev safety net)
        Model::shouldBeStrict(! app()->isProduction());

        // Remove wrapping from API resources for cleaner responses
        JsonResource::withoutWrapping();

        // Force HTTPS in production
        if (app()->isProduction()) {
            URL::forceScheme('https');
        }
    }
}
