<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css">
</head>

<header class="bg-gray-100">
<nav class="bg-blue-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
        <div class="flex items-center justify-between w-full h-16">
            <a href="{{ route('stations.show') }}"
               class="px-3 py-2 rounded-md text-sm font-medium text-white {{ Request::is('stations') ? 'bg-blue-900' : '' }} hover:bg-blue-700 hover:text-white">All
                E-stations</a>
            <a href="{{ route('stations.create') }}"
               class="px-3 py-2 rounded-md text-sm font-medium text-white {{ Request::is('stations/create') ? 'bg-blue-900' : '' }} hover:bg-blue-700 hover:text-white">Create
                E-station</a>
            <form action="{{ route('stations.show') }}" method="GET" class="flex items-center ml-4">
                @csrf
                <label for="city" class="text-white text-sm mr-2">Find a Station in:</label>
                <div class="relative flex items-center">
                    <input type="text" name="city" id="city"
                           class="block mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm py-1 px-2 placeholder-gray-400"
                           placeholder="City Name">
                    <div class="flex items-center ml-2">
                        <input type="checkbox" id="isOpen" name="isOpen"
                               value="1" {{ request()->input('isOpen') ? 'checked' : '' }}>
                        <label for="isOpen" class="text-white text-sm ml-1">Open Only</label>
                    </div>
                    <button type="submit"
                            class="ml-2 px-4 py-1.5 rounded-md font-medium text-sm text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Find
                    </button>
                </div>
            </form>
            <form action="{{ route('stations.nearest') }}" method="GET" class="flex items-center ml-4">
                <label for="latitude" class="text-white text-sm mr-2">Find Nearby Stations:</label>
                <div class="relative flex items-center">
                    <input type="text" name="latitude" id="latitude"
                           class="block mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm py-1 px-2 placeholder-gray-400"
                           placeholder="Latitude" required>
                    <label for="longitude" class="sr-only">Longitude</label>
                    <input type="text" name="longitude" id="longitude"
                           class="block mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm py-1 px-2 placeholder-gray-400"
                           placeholder="Longitude" required>
                    <button type="submit"
                            class="ml-2 px-4 py-1.5 rounded-md font-medium text-sm text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Find
                    </button>
                </div>
            </form>
        </div>
    </div>
</nav>
</header>
<body><div class="py-10">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="bg-white rounded-lg shadow-lg p-6">
            @yield('content')
        </div>
    </div>
    <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        @yield('scripts')
    </div>
</div>
</body>
</html>
