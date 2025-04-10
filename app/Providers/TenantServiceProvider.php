<?php

namespace App\Providers;

use App\Services\TenantManager;
use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(TenantManager::class, function ($app) {
            return new TenantManager();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->singleton('Tenant', function ($app) {
            // Logic to determine the tenant based on the request
            $tenant = $this->getTenantFromRequest();

            // Set the database connection for the tenant
            \Config::set('database.connections.mysql.database', $tenant->database_name);
            \DB::purge('mysql');
            \DB::reconnect('mysql');

            return $tenant;
        });
    }

    protected function getTenantFromRequest()
    {
        $host = request()->getHost();
        $subdomain = explode('.', $host)[0];

        // Fetch tenant information from the database using the domain
        $tenant = \App\Models\Tenant::where('domain', $subdomain)->first();

        if (!$tenant || !$tenant->isActive()) {
            abort(404, 'Tenant not found or inactive');
        }

        return $tenant;
    }
}
