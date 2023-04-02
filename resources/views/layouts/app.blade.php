<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .nav-link {
            transition: all 0.2s ease-in-out;
        }
        .nav-link:hover {
            transform: translateY(-2px);
            color: #fff;
        }
    </style>
</head>
<body>
<nav class="bg-blue-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('estations.index') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white {{ Request::is('estations') ? 'bg-gray-900' : '' }} hover:bg-gray-700 hover:text-white">All Stations</a>
                        <a href="{{ route('estations.create') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white {{ Request::is('estations/create') ? 'bg-gray-900' : '' }} hover:bg-gray-700 hover:text-white">Create Station</a>
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
