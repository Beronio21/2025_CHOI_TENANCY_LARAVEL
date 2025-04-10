<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use Illuminate\Support\Facades\Log;

class IdentifyTenant
{
    public function handle($request, Closure $next)
    {
        Log::info('Request received in IdentifyTenant middleware', ['url' => $request->url()]);
        // Example: Identify tenant by subdomain
        $subdomain = explode('.', $request->getHost())[0];
        $tenant = Tenant::where('subdomain', $subdomain)->first();

        if (!$tenant) {
            abort(404, 'Tenant not found');
        }

        // Set the tenant in the application context
        app()->instance('tenant', $tenant);

        return $next($request);
    }
} 