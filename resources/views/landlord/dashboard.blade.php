<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Landlord Dashboard') }}
        </h2>
    </x-slot>

    <x-landlord-navigation />

    <div class="flex">
        <aside class="w-1/4 bg-gray-200 p-4">
            <h3 class="font-semibold text-lg">Manage</h3>
            <ul>
                <li><a href="#" class="text-blue-500">Manage Workers</a></li>
                <li><a href="#" class="text-blue-500">Manage Clients</a></li>
                <li><a href="#" class="text-blue-500">Manage Laundry</a></li>
            </ul>
        </aside>

        <main class="w-3/4">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <p>Workers: {{ $workerCount }}</p>
                            <p>Clients: {{ $clientCount }}</p>
                            <p>Laundry Logs: {{ $laundryCount }}</p>
                            <p>Total Earnings: ${{ $totalEarnings }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-red-500">Logout</button>
    </form>
</x-layout> 