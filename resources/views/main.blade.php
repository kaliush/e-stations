<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Stations - Ukraine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
<div class="container mx-auto py-12">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-4">Welcome to E-Stations in Ukraine</h1>
    <p class="text-lg text-center text-gray-600 mb-8">Find and charge your electric vehicle at one of our convenient locations across Ukraine.</p>
    <div class="flex justify-center space-x-4">
        <x-button href="{{ route('estations.index') }}" bg="bg-blue-500" hover="hover:bg-blue-600" text="text-white" font="font-semibold">
            Show all Stations
            <span class="badge badge-light">{{ $stationCount }}</span>
        </x-button>

        <x-button href="{{ route('estations.create') }}" bg="bg-green-500" hover="hover:bg-green-600" text="text-white" font="font-semibold">
            Add a New Station
        </x-button>

        <x-button href="{{ route('estations.index') }}" bg="bg-yellow-500" hover="hover:bg-yellow-600" text="text-white" font="font-semibold">
            Update a Station
        </x-button>

        <x-button href="{{ route('estations.index') }}" bg="bg-red-500" hover="hover:bg-red-600" text="text-white" font="font-semibold">
            Delete a Station
        </x-button>

        @foreach($cities as $city)
            <x-button href="{{ route('estations.byCity', $city) }}" bg="bg-indigo-500" hover="hover:bg-indigo-600" text="text-white" font="font-semibold">
                {{ $city }} Stations
            </x-button>
        @endforeach

        <x-button href="{{ route('estations.byStatus', 'open') }}" bg="bg-purple-500" hover="hover:bg-purple-600" text="text-white" font="font-semibold">
            Open Stations
            <span class="badge badge-light">{{ $openCount }}</span>
        </x-button>

        <x-button href="{{ route('estations.show', $closestStation->id) }}" bg="bg-teal-500" hover="hover:bg-teal-600" text="text-white" font="font-semibold">
            Closest Open Station
            <span class="badge badge-light">{{ $closestStation->distance }} km</span>
        </x-button>
    </div>
</div>
</body>
</html>
