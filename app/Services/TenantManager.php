<?php

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class TenantManager
{
    private ?Tenant $currentTenant = null;

    public function setTenant(Tenant $tenant): void
    {
        $this->currentTenant = $tenant;
        $this->configureTenantConnection();
    }

    public function getCurrentTenant(): ?Tenant
    {
        return $this->currentTenant;
    }

    private function configureTenantConnection(): void
    {
        if (!$this->currentTenant) {
            return;
        }

        Config::set('database.connections.tenant', [
            'driver' => 'mysql',
            'host' => config('database.connections.mysql.host'),
            'port' => config('database.connections.mysql.port'),
            'database' => $this->currentTenant->getDatabaseName(),
            'username' => config('database.connections.mysql.username'),
            'password' => config('database.connections.mysql.password'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ]);

        DB::purge('tenant');
        DB::reconnect('tenant');
    }

    public function createTenantDatabase(Tenant $tenant): void
    {
        $database = $tenant->getDatabaseName();
        
        DB::statement("CREATE DATABASE IF NOT EXISTS `{$database}`");
        
        $this->setTenant($tenant);
        
        // Run migrations for the new tenant
        $this->runTenantMigrations();
    }

    private function runTenantMigrations(): void
    {
        $this->setTenant($this->currentTenant);
        
        // Run migrations for the tenant database
        \Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path' => 'database/migrations/tenant',
            '--force' => true,
        ]);
    }
}
