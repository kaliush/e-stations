<?php

namespace App\Http\Controllers;

use App\Models\Estations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstationsController extends Controller
{
    public function index()
    {
        $stations = Estations::all();
        return view('estations.index', compact('stations'));
    }

    public function create()
    {
        return view('/estations/create');
    }
    public function store(Request $request)
    {

        // validate the input
        $validatedData = $request->validate([
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'is_open' => 'boolean',
        ]);


        try {
            // create a new estation with the validated data
            $estation = new Estations($validatedData);
            $estation->save();
        } catch (\Exception $e) {
            // redirect to the index page with an error message
            return redirect('/estations/create')->with('error', 'There was an error creating the station.');
        }

        // redirect to the index page with a success message
        return redirect('/estations/create')->with('success', 'Station created successfully.');
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


}

