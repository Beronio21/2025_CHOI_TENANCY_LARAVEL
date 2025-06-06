<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Services\TenantManager;
use Illuminate\Http\Request;
use App\Mail\ResendPasswordMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User; // Assuming you have a User model
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
            'subscription_plan' => 'required|string|max:255',
        ]);

        try {
            $tenant = Tenant::create([
                'name' => $validated['name'],
                'domain' => $validated['domain'],
                'database' => $validated['database'],
                'is_active' => $validated['status'] === 'active',
                'email' => $validated['email'],
                'subscription_plan' => $validated['subscription_plan'],
            ]);

            $tenantManager->createTenantDatabase($tenant);

            return redirect('/')->with('success', 'Tenant registered successfully.');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Failed to register tenant.');
        }
    }

    public function changeSubscriptionPlan(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'subscription_plan' => 'required|string|max:255',
        ]);

        $tenant->update(['subscription_plan' => $validated['subscription_plan']]);

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Subscription plan updated successfully.');
    }

    public function resendPassword($userId)
    {
        $user = User::find($userId);

        if ($user) {
            Mail::to($user->email)->send(new ResendPasswordMail($user, $user->password));
            return back()->with('success', 'Password reset email sent!');
        }

        return back()->with('error', 'User not found.');
    }

    public function activateTenant($tenantId)
    {
        $tenant = Tenant::find($tenantId);

        if ($tenant && !$tenant->is_active) {
            // Activate the tenant
            $tenant->is_active = true;

            // Generate a random password
            $password = Str::random(8);
            $tenant->password = Hash::make($password);

            // Save the tenant
            $tenant->save();

            // Send the password email
            Mail::to($tenant->email)->send(new ResendPasswordMail($tenant, $password));

            return back()->with('success', 'Tenant activated and password sent!');
        }

        return back()->with('error', 'Tenant not found or already active.');
    }
}
