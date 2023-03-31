<?php

namespace App\Http\Controllers;

use App\Models\Estations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstationsController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'is_open' => 'required|boolean'
        ]);

        $estation = Estations::create($validatedData);

        return response()->json([
            'message' => 'E-station created successfully',
            'data' => $estation
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'city' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'is_open' => 'sometimes|required|boolean',
            'latitude' => 'sometimes|required|numeric',
            'longitude' => 'sometimes|required|numeric',
        ]);

        $estation = Estations::find($id);
        if (!$estation) {
            return response()->json(['message' => 'E-station not found'], 404);
        }

        $estation->fill($validatedData);
        $estation->save();

        return response()->json([
            'message' => 'E-station updated successfully',
            'data' => $estation
        ]);
    }

    public function destroy($id)
    {
        $estation = Estations::findOrFail($id);
        $estation->delete();

        return response()->json([
            'message' => 'E-station deleted successfully'
        ], 200);
    }

    public function getByCity($city)
    {
        $estations = Estations::where('city', $city)->get();

        return response()->json([
            'data' => $estations
        ]);
    }

    public function getOpenByCity($city)
    {
        $openStations = Estations::where('city', $city)
            ->where('status', 'open')
            ->get();

        return response()->json([
            'message' => 'Open E-stations retrieved successfully',
            'data' => $openStations
        ], 200);
    }

    public function getClosestOpen(Request $request)
    {
        $userLatitude = $request->input('latitude');
        $userLongitude = $request->input('longitude');

        $estations = Estations::where('is_open', true)
            ->select('id', 'name', 'city', 'address', 'latitude', 'longitude',
                DB::raw("( 6371 * acos( cos( radians($userLatitude) ) * cos( radians( latitude ) ) *
            cos( radians( longitude ) - radians($userLongitude) ) + sin( radians($userLatitude) ) *
            sin( radians( latitude ) ) ) ) AS distance"))
            ->orderBy('distance')
            ->first();

        return response()->json([
            'data' => $estations
        ]);
    }
    public function index()
    {
        $stationCount = Estations::all()->count();
        $cities = Estations::distinct('city')->pluck('city');
        $openCount = Estations::where('status', 'open')->count();
        $closestStation = Estations::where('status', 'open')->orderBy('distance')->first();

        return view('main', compact('stationCount', 'cities', 'openCount', 'closestStation'));
    }

}

