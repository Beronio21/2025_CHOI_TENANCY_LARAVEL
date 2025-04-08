<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Services\TenantManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    public function __construct(
        private TenantManager $tenantManager
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        
        $tenant = Tenant::where('domain', $host)
            ->where('is_active', true)
            ->first();

        if (!$tenant) {
            abort(404, 'Tenant not found');
        }

        $this->tenantManager->setTenant($tenant);

        return $next($request);
    }
}
