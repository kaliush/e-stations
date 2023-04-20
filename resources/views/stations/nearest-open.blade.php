@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="max-w-7xl rounded overflow-hidden shadow-lg">
            <div class="bg-gray-200 px-10 py-8">
                <h1 class="text-2xl font-bold mb-4">Closest Station</h1>
                @if ($station)
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-8 mb-8">
                        <div class="w-full md:w-1/2">
                            <h4 class="font-bold mb-2">{{ $station->name }}</h4>
                            <p class="text-gray-700 text-base mb-2">{{ $station->address }}</p>
                            <p class="text-gray-700 text-base">{{ $station->city }}</p>
                            <p class="text-gray-700 text-base">Opening
                                hours: {{ $station->opening_hours }}</p>
                            <p class="text-gray-700 text-base">Closing
                                hours: {{ $station->closing_hours }}</p>
                            <div class="flex justify-center md:justify-start mt-4">
                                <a href="https://www.google.com/maps/dir/?api=1&destination={{ $station->latitude }},{{ $station->longitude }}"
                                   target="_blank"
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Get
                                    Directions</a>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div id="map" style="width: 200px; height: 200px;"></div>
                        </div>
                    </div>
                @else
                    <p class="text-gray-700 text-base">No open stations found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
    <script>
        function initMap() {
            const station = {lat: {{ $station->latitude }}, lng: {{ $station->longitude }}};
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: station,
            });
            new google.maps.Marker({
                position: station,
                map,
                label: {
                    text: "S",
                    color: "white",
                },
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
@endsection
