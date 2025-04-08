@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Admin Dashboard</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Overview of the system.</p>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
        <p>Welcome to the admin dashboard. Here you can manage tenants and other administrative tasks.</p>
    </div>
</div>
@endsection 