<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
<nav class="bg-blue-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('estations.show') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white {{ Request::is('estations') ? 'bg-blue-900' : '' }} hover:bg-blue-700 hover:text-white">All Estations</a>
                        <a href="{{ route('estations.create') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white {{ Request::is('estations/create') ? 'bg-blue-900' : '' }} hover:bg-blue-700 hover:text-white">Create Estation</a>
                        <form action="{{ route('estations.filter') }}" method="GET" class="flex items-center">
                            <label for="city" class="text-white text-sm mr-2">Enter a City Name:</label>
                            <div class="relative flex">
                                <input type="text" name="city" id="city" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm py-1.5 pr-3 pl-10 placeholder-gray-400" placeholder="Search">
                                <button type="submit" class="absolute right-0 top-0 mt-1.5 mr-1.5 px-4 py-1.5 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-blue-600 hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @yield('content')
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
