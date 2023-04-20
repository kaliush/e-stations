@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto my-10">
        <h1 class="text-center font-bold text-2xl mb-5 ">Create a new station</h1>
        <form action="{{ route('stations.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <x-form.input name="name" label="Name:" placeholder="Enter name of station" />
            <x-form.input name="city" label="City:" placeholder="Enter city of station" />
            <x-form.input name="address" label="Address:" placeholder="Enter the address" />
            <x-form.input name="latitude" label="Latitude:" placeholder="Enter latitude of station" />
            <x-form.input name="longitude" label="Longitude:" placeholder="Enter longitude of station" />
            <x-form.input type="time" name="opening_hours" label="Opening Hours" />
            <x-form.input type="time" name="closing_hours" label="Closing Hours" />
            <x-form.button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Station
            </x-form.button>
        </form>
    </div>
@endsection
