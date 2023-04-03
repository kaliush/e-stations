@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <form action="{{ route('estations.filter') }}" method="GET">
                <label for="city">Select a City:</label>
                <select name="city" id="city" class="block w-full mt-1">
                    <option value="">--Select a city--</option>
                    @foreach($cities as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                </select>
                <button type="submit" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-blue-600 hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    <span class="mr-2">Filter</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-2a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M9 7a1 1 0 012 0v5a1 1 0 01-2 0V7zm-1.707 2.293a1 1 0 111.414-1.414l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L9.586 10 7.293 7.707z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
            @if(isset($estations))
                <h2 class="text-2xl font-bold mt-6">{{ $selected_city }} Estations</h2>
                <table class="table-auto w-full mt-4">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">City</th>
                        <th class="px-4 py-2">Address</th>
                        <th class="px-4 py-2">Latitude</th>
                        <th class="px-4 py-2">Longitude</th>
                        <th class="px-4 py-2">Is Open</th>
                        <th class="px-4 py-2">Created At</th>
                        <th class="px-4 py-2">Updated At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($estations as $estation)
                        <tr>
                            <td class="border px-4 py-2"><a href="{{ route('estations.show', ['id' => $estation->id]) }}" class="text-blue-500 hover:text-blue-700">{{ $estation->name }}</a></td>
                            <td class="border px-4 py-2">{{ $estation->city }}</td>
                            <td class="border px-4 py-2">{{ $estation->address }}</td>
                            <td class="border px-4 py-2">{{ $estation->latitude }}</td>
                            <td class="border px-4 py-2">{{ $estation->longitude }}</td>
                            <td class="border px-4 py-2">{{ $estation->is_open ? 'Yes' : 'No' }}</td>
                            <td class="border px-4 py-2">{{ $estation->created_at }}</td>
                            <td class="border px-4 py-2">{{ $estation->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
