<?php

namespace App\Http\Controllers;

use App\Models\Estations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstationsController extends Controller
{
    public function show()
    {
        $estations = Estations::all();
        return view('estations.show', compact('estations'));
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

    public function edit($id)
    {
        $estation = Estations::findOrFail($id);
        return view('estations.edit', compact('estation'));
    }

    public function update(Request $request, $id)
    {
        $estation = Estations::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'city' => 'required|max:255',
            'address' => 'required|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'is_open' => 'required|boolean'
        ]);

        $estation->update($validatedData);
        return redirect()->route('estations.show')
            ->with('success', 'Estation updated successfully');
    }

    public function destroy($id)
    {
        $estation = Estations::findOrFail($id);
        $estation->delete();

        return redirect()->route('estations.show')
            ->with('success', 'Station has been deleted.');
    }


    public function filter(Request $request)
    {
        $selected_city = $request->input('city');

        $estations = Estations::where('city', $selected_city)->get();

        if ($estations->count() == 0) {
            return back()->with('error', 'No stations in the city yet.');
        }

        return view('estations.show', [
            'estations' => $estations,
            'selected_city' => $selected_city
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

    protected function validateEstations(?Estations $estation = null): array
    {
        $estation ??= new Estations();

        return request()->validate([
            'name' => 'required|max:255',
            'city' => 'required|max:255',
            'address' => 'required|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'is_open' => 'required|boolean'
        ]);
    }


}

