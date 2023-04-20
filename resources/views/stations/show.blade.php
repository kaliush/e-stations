@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-8">Stations</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($stations as $station)
                <div class="border border-gray-200 rounded-md p-4">
                    <h2 class="text-lg font-semibold">{{ $station->getName() }}</h2>
                    <p class="text-gray-500">{{ $station->getCity() }}</p>
                    <p class="text-gray-500">{{ $station->getAddress() }}</p>
                    <p class="text-gray-500">Latitude: {{ $station->getLatitude() }}</p>
                    <p class="text-gray-500">Longitude: {{ $station->getLongitude() }}</p>
                    <p class="text-gray-500">
                        Status:
                        @if ($station->isOpen())
                            <span class="text-green-500 font-semibold">Open</span>
                        @else
                            <span class="text-red-500 font-semibold">Closed</span>
                        @endif
                    </p>
                    <p class="text-gray-500">
                        Opening hours: {{ $station->getOpeningHours() ?? 'N/A' }}
                    </p>
                    <p class="text-gray-500">
                        Closing hours: {{ $station->getClosingHours() ?? 'N/A' }}
                    </p>
                    <a href="{{ route('stations.edit', $station->getId()) }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Edit
                    </a>
                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $station->getLatitude() }},{{ $station->getLongitude() }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Get Directions
                    </a>
                    <form id="delete-form" action="{{ route('stations.delete', $station->getId()) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center mt-2 px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-red-600 hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150" onclick="return confirmDelete()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 8v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2zm6-2V5a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v1H4a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1v6a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-6h1a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-2zm-4 0h2v1h-2V6zM8 8v8h4V8H8z" clip-rule="evenodd"/>
                            </svg>
                            Delete
                        </button>
                    </form>
                    <script>
                        function confirmDelete() {
                            return confirm("Are you sure you want to delete this?");
                        }
                    </script>
                </div>
            @endforeach
        </div>
    </div>
@endsection
