@extends('layouts.admin')

@section('title', 'Edit Laundry Log')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Laundry Log</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Update the details of the laundry log.</p>
    </div>

    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
        <form action="{{ route('admin.laundry_logs.update', $laundryLog->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" id="date" value="{{ $laundryLog->date }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="time_started" class="block text-sm font-medium text-gray-700">Time Started</label>
                    <input type="time" name="time_started" id="time_started" value="{{ $laundryLog->time_started }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="person_responsible" class="block text-sm font-medium text-gray-700">Person Responsible</label>
                    <input type="text" name="person_responsible" id="person_responsible" value="{{ $laundryLog->person_responsible }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="items_washed" class="block text-sm font-medium text-gray-700">Items Washed</label>
                    <input type="text" name="items_washed" id="items_washed" value="{{ $laundryLog->items_washed }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="quantity_items" class="block text-sm font-medium text-gray-700">Quantity Items</label>
                    <input type="number" name="quantity_items" id="quantity_items" value="{{ $laundryLog->quantity_items }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="how_many_kilo" class="block text-sm font-medium text-gray-700">How Many Kilo</label>
                    <input type="number" name="how_many_kilo" id="how_many_kilo" value="{{ $laundryLog->how_many_kilo }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="machine_used" class="block text-sm font-medium text-gray-700">Machine Used</label>
                    <input type="text" name="machine_used" id="machine_used" value="{{ $laundryLog->machine_used }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="detergent_used" class="block text-sm font-medium text-gray-700">Detergent Used</label>
                    <input type="text" name="detergent_used" id="detergent_used" value="{{ $laundryLog->detergent_used }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="how_many_detergent_used" class="block text-sm font-medium text-gray-700">How Many Detergent Used</label>
                    <input type="number" name="how_many_detergent_used" id="how_many_detergent_used" value="{{ $laundryLog->how_many_detergent_used }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="drying_method" class="block text-sm font-medium text-gray-700">Drying Method</label>
                    <input type="text" name="drying_method" id="drying_method" value="{{ $laundryLog->drying_method }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end">
                <a href="{{ route('admin.laundry_logs.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                </a>
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Update Log
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 