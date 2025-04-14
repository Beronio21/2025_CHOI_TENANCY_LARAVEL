<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Services\TenantManager;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::latest()->paginate(10);
        return view('admin.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TenantManager $tenantManager)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:tenants',
            'database' => 'required|string|max:255|unique:tenants',
            'email' => 'required|string|email|max:255|unique:tenants',
        ]);

        $tenant = Tenant::create([
            'name' => $validated['name'],
            'domain' => $validated['domain'],
            'database' => $validated['database'],
            'is_active' => true,
            'email' => $validated['email'],
        ]);

        $tenantManager->createTenantDatabase($tenant);

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        return view('admin.tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        return view('admin.tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:tenants,domain,' . $tenant->id,
            'database' => 'required|string|max:255|unique:tenants,database,' . $tenant->id,
            'is_active' => 'boolean',
            'email' => 'required|string|email|max:255|unique:tenants,email,' . $tenant->id,
        ]);

        $tenant->update($validated);

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        // In a real application, you might want to handle database deletion here
        $tenant->delete();

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant deleted successfully.');
    }

    public function register(Request $request, TenantManager $tenantManager)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:tenants',
            'database' => 'required|string|max:255|unique:tenants',
            'status' => 'required|string|in:active,inactive',
            'email' => 'required|string|email|max:255|unique:tenants',
        ]);

        try {
            $tenant = Tenant::create([
                'name' => $validated['name'],
                'domain' => $validated['domain'],
                'database' => $validated['database'],
                'is_active' => $validated['status'] === 'active',
                'email' => $validated['email'],
            ]);

            $tenantManager->createTenantDatabase($tenant);

            return redirect('/')->with('success', 'Tenant registered successfully.');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Failed to register tenant.');
        }
    }
}
