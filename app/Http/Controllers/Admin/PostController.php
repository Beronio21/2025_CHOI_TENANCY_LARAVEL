<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tenant;
use App\Services\TenantManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Use the default connection for admin post listing
        $posts = DB::connection('mysql')
            ->table('posts')
            ->join('tenants', 'posts.tenant_id', '=', 'tenants.id')
            ->select('posts.*', 'tenants.name as tenant_name')
            ->latest('posts.created_at')
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tenants = Tenant::where('is_active', true)->get();
        return view('admin.posts.create', compact('tenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TenantManager $tenantManager)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $tenant = Tenant::findOrFail($validated['tenant_id']);
        $tenantManager->setTenant($tenant);

        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $tenants = Tenant::where('is_active', true)->get();
        return view('admin.posts.edit', compact('post', 'tenants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, TenantManager $tenantManager)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $tenant = Tenant::findOrFail($validated['tenant_id']);
        $tenantManager->setTenant($tenant);

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
