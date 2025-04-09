@extends('layouts.admin')

@section('title', 'Laundry Logs')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">Laundry Logs</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">List of all laundry logs.</p>
        </div>
        <a href="{{ route('admin.laundry_logs.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Add Laundry Log
        </a>
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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($laundryLogs as $log)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->date }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->time_started }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->person_responsible }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->items_washed }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->quantity_items }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->how_many_kilo }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->machine_used }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->detergent_used }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->how_many_detergent_used }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $log->drying_method }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.laundry_logs.show', $log->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                        <a href="{{ route('admin.laundry_logs.edit', $log->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                        <form action="{{ route('admin.laundry_logs.destroy', $log->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this log?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 