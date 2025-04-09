@extends('layouts.admin')

@section('title', 'Laundry Logs')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">Laundry Logs</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">List of all laundry logs.</p>
        </div>
    </div>
    
    <div class="border-t border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time Started</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Person Responsible</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items Washed</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity Items</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">How Many Kilo</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Machine Used</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detergent Used</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">How Many Detergent Used</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Drying Method</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Example row -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-04-09</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">08:00 AM</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">John Doe</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Shirts, Pants</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Washer 1</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Tide</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Air Dry</td>
                </tr>
                <!-- More rows... -->
            </tbody>
        </table>
    </div>
</div>
@endsection 