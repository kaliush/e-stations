@extends('layout')

@section('title', 'E-Stations - Ukraine')

@section('content')
    <div class="container mx-auto py-12">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-4">Welcome to E-Stations in Ukraine</h1>
        <p class="text-lg text-center text-gray-600 mb-8">Find and charge your electric vehicle at one of our convenient locations across Ukraine.</p>
        <div class="flex justify-center space-x-4">
            <x-button href="/estations/index" bg="bg-blue-500" hover="hover:bg-blue-600" text="text-white" font="font-semibold">
                Show all Stations
            </x-button>

            <x-button href="/estations/create" bg="bg-green-500" hover="hover:bg-green-600" text="text-white" font="font-semibold">
                Add a New Station
            </x-button>

            <x-button href="#" bg="bg-yellow-500" hover="hover:bg-yellow-600" text="text-white" font="font-semibold">
                Update a Station
            </x-button>

            <x-button href="#" bg="bg-red-500" hover="hover:bg-red-600" text="text-white" font="font-semibold" onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                Delete a Station
            </x-button>

            <form id="delete-form" action="#" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>


            <x-button href="#" bg="bg-purple-500" hover="hover:bg-purple-600" text="text-white" font="font-semibold">
                Open Stations in Kiev
            </x-button>

            <x-button href="#" bg="bg-teal-500" hover="hover:bg-teal-600" text="text-white" font="font-semibold">
                Closest Open Station
            </x-button>
        </div>
    </div>
@endsection
