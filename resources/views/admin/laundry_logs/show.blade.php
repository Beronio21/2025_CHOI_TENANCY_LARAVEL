@extends('layouts.admin')

@section('title', 'View Laundry Log')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Laundry Log Details</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Details of the selected laundry log.</p>
    </div>

    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Date</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $laundryLog->date }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Time Started</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $laundryLog->time_started }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Person Responsible</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $laundryLog->person_responsible }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Items Washed</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $laundryLog->items_washed }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Quantity Items</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $laundryLog->quantity_items }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">How Many Kilo</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $laundryLog->how_many_kilo }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Machine Used</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $laundryLog->machine_used }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Detergent Used</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $laundryLog->detergent_used }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">How Many Detergent Used</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $laundryLog->how_many_detergent_used }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Drying Method</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $laundryLog->drying_method }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection 