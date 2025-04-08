<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Post;
use App\Services\TenantManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $tenantCount = Tenant::count();
        $activeTenantCount = Tenant::where('is_active', true)->count();
        
        // Use the default connection for counting posts
        $postCount = DB::connection('mysql')->table('posts')->count();
        
        return view('admin.dashboard.index', compact('tenantCount', 'activeTenantCount', 'postCount'));
    }
}
