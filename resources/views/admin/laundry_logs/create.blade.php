@extends('layouts.admin')

@section('title', 'Create Laundry Log')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Create New Laundry Log</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Add a new laundry log entry.</p>
    </div>

    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
        <form action="{{ route('admin.laundry_logs.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" id="date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="time_started" class="block text-sm font-medium text-gray-700">Time Started</label>
                    <input type="time" name="time_started" id="time_started" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="person_responsible" class="block text-sm font-medium text-gray-700">Person Responsible</label>
                    <input type="text" name="person_responsible" id="person_responsible" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="items_washed" class="block text-sm font-medium text-gray-700">Items Washed</label>
                    <select name="items_washed" id="items_washed" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="Shirts">Shirts</option>
                        <option value="Pants">Pants</option>
                        <option value="Towels">Towels</option>
                        <option value="Bedding">Bedding</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div>
                    <label for="quantity_items" class="block text-sm font-medium text-gray-700">Quantity Items</label>
                    <input type="number" name="quantity_items" id="quantity_items" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="how_many_kilo" class="block text-sm font-medium text-gray-700">How Many Kilo</label>
                    <input type="number" name="how_many_kilo" id="how_many_kilo" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="machine_used" class="block text-sm font-medium text-gray-700">Machine Used</label>
                    <select name="machine_used" id="machine_used" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="Washer 1">Washer 1</option>
                        <option value="Washer 2">Washer 2</option>
                        <option value="Dryer 1">Dryer 1</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div>
                    <label for="detergent_used" class="block text-sm font-medium text-gray-700">Detergent Used</label>
                    <select name="detergent_used" id="detergent_used" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="Tide">Tide</option>
                        <option value="Ariel">Ariel</option>
                        <option value="Persil">Persil</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div>
                    <label for="how_many_detergent_used" class="block text-sm font-medium text-gray-700">How Many Detergent Used</label>
                    <input type="number" name="how_many_detergent_used" id="how_many_detergent_used" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="drying_method" class="block text-sm font-medium text-gray-700">Drying Method</label>
                    <select name="drying_method" id="drying_method" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="Air Dry">Air Dry</option>
                        <option value="Drying Machine">Drying Machine</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end">
                <a href="{{ route('admin.laundry_logs.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                </a>
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Log
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 