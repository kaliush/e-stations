@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex flex-col items-center justify-center py-20">
            <h1 class="text-4xl font-bold mb-4">Welcome to our E-stations API!</h1>
            <p class="text-lg mb-8">We provide comprehensive data on electric vehicle charging stations to help you find the nearest charging station, plan your trip, and more.</p>
            <h2 class="text-2xl font-bold mb-4">Features and Functions</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="p-6 bg-white rounded-lg shadow-lg">
                    <h3 class="text-lg font-bold mb-4">Search for Charging Stations</h3>
                    <p class="text-gray-700 mb-4">You can search for charging stations by location, using various parameters such as city, zip code, and more. You can also filter the results to show only open stations or stations with specific types of connectors.</p>
                    <a href="{{ route('estations.show') }}" class="text-blue-500 hover:text-blue-700 font-medium">Explore Search Functionality &rarr;</a>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-lg">
                    <h3 class="text-lg font-bold mb-4">Add and Edit Charging Stations</h3>
                    <p class="text-gray-700 mb-4">Our API also allows you to add and edit charging stations. If you come across a new charging station or find that the information for an existing one is incorrect, you can submit an update request or add the station to the database.</p>
                    <a href="{{ route('estations.create') }}" class="text-blue-500 hover:text-blue-700 font-medium">Add or Edit Charging Stations &rarr;</a>
                </div>
            </div>
        </div>
    </div>
@endsection
