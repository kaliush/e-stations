@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 ">
            <form action="{{ route('stations.update', ['id' => $station->id]) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form.input name="name" label="Name" type="text" :value="$station->name"/>
                    <x-form.input name="city" label="City" type="text" :value="$station->city"/>
                    <x-form.input name="address" label="Address" type="text" :value="$station->address"/>
                    <x-form.input name="latitude" label="Latitude" type="text" :value="$station->latitude"/>
                    <x-form.input name="longitude" label="Longitude" type="text" :value="$station->longitude"/>
                    <x-form.input name="opening_hours" label="Opening Hours" type="time" :value="$station->opening_hours"/>
                    <x-form.input name="closing_hours" label="Closing Hours" type="time" :value="$station->closing_hours"/>

                    <div class="mt-12 ml-5">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md transition duration-200 ease-in-out">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
