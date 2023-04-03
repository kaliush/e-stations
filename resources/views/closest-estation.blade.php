@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="max-w-lg rounded overflow-hidden shadow-lg">
            <div class="bg-gray-200 px-6 py-4">
                <h1 class="text-2xl font-bold mb-2">Closest Station</h1>
                @if ($closestEstation)
                    <div class="flex flex-row mb-4">
                        <div class="w-1/2 pr-4">
                            <h4 class="font-bold mb-2">{{ $closestEstation->name }}</h4>
                            <p class="text-gray-700 text-base mb-2">{{ $closestEstation->address }}</p>
                            <p class="text-gray-700 text-base">{{ $closestEstation->city }}</p>
                            <p class="text-gray-700 text-base">Opening hours: {{ $closestEstation->opening_hours }}</p>
                            <p class="text-gray-700 text-base">Closing hours: {{ $closestEstation->closing_hours }}</p>
                        </div>
                        <div class="w-1/2">
                            <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $closestEstation->latitude }},{{ $closestEstation->longitude }}&markers=color:red%7Clabel:S%7C{{ $closestEstation->latitude }},{{ $closestEstation->longitude }}&zoom=14&size=400x400&key=IzaSyB1gYqI8OdG1ZdutEci6A3T57kI60EyNLo" alt="Map showing the location of the station">
                        </div>
                    </div>
                    <p class="text-gray-700 text-base mb-2">Distance: {{ $distance }} km</p>
                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $closestEstation->latitude }},{{ $closestEstation->longitude }}" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Get Directions</a>
                @else
                    <p class="text-gray-700 text-base">No open stations found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
