@extends('layout')

@section('title', 'E-Stations - Ukraine')

@section('content')
    <div class="container mx-auto py-12">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-4">Welcome to E-Stations in Ukraine</h1>
        <p class="text-lg text-center text-gray-600 mb-8">Find and charge your electric vehicle at one of our convenient locations across Ukraine.</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('estations.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-full ">
                Show all Stations
            </a>

            <a href="{{ route('estations.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-full">
                Add a New Station
            </a>

            <a href="{{ route('estations.edit', ['id' => $estation->id]) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded-full">
                Update a Station
            </a>

            <form id="delete-form" action="#" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            <button class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-full" onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                Delete a Station
            </button>

            <a href="#" class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-6 rounded-full">
                Open Stations in Kiev
            </a>

            <a href="#" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-6 rounded-full">
                Closest Open Station
            </a>
        </div>
    </div>
@endsection
