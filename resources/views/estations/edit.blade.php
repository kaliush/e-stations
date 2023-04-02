@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <form action="{{ route('estations.update', ['id' => $estation->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                <input id="name" type="text" name="name" value="{{ $estation->name }}" required
                                       autofocus
                                       class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                @error('name')
                                <p class="text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                <input id="city" type="text" name="city" value="{{ $estation->city }}" required
                                       class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                @error('city')
                                <p class="text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="address"
                                       class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                <input id="address" type="text" name="address" value="{{ $estation->address }}" required
                                       class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                @error('address')
                                <p class="text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="latitude"
                                       class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                                <input id="latitude" type="text" name="latitude" value="{{ $estation->latitude }}"
                                       required
                                       class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                @error('latitude')
                                <p class="text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="longitude">
                                    Longitude
                                </label>
                                <input id="longitude" type="text" name="longitude" value="{{ $estation->longitude }}"
                                       required
                                       class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                @error('longitude')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2" for="is_open">
                                    Is Open
                                </label>
                                <select id="is_open" name="is_open" required
                                        class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="" disabled selected>Select</option>
                                    <option value="1" {{ $estation->is_open ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ !$estation->is_open ? 'selected' : '' }}>No</option>
                                </select>
                                @error('is_open')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md transition duration-200 ease-in-out">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
