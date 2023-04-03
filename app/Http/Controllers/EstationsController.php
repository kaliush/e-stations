<?php

namespace App\Http\Controllers;

use App\Models\Estations;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstationsController extends Controller
{
    public function show(Request $request)
    {
        $query = Estations::query();

        if ($request->has('city')) {
            $query->where('city', $request->input('city'));
        }

        if ($request->has('isOpen')) {
            $estations = $query->get()->filter(function ($estation) {
                return $estation->isOpen();
            });
        } else {
            $estations = $query->get();
        }

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
        ]);

        try {
            // create a new estation with the validated data
            $estation = new Estations($validatedData);
            $estation->save();
        } catch (\Exception $e) {
            // redirect to the create page with an error message
            return redirect('/estations/create')->with('error', 'There was an error creating the station.');
        }
        // redirect to the show page with a success message
        return redirect('/estations/show')->with('success', 'Station created successfully.');
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
            'opening_hours' => 'required|date_format:H:i',
            'closing_hours' => 'required|date_format:H:i',
        ]);

        $estation->name = $validatedData['name'];
        $estation->city = $validatedData['city'];
        $estation->address = $validatedData['address'];
        $estation->latitude = $validatedData['latitude'];
        $estation->longitude = $validatedData['longitude'];
        $estation->opening_hours = $validatedData['opening_hours'];
        $estation->closing_hours = $validatedData['closing_hours'];
        $estation->save();

        return redirect()->route('estations.show', $id)
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
        $isOpen = $request->has('isOpen');

        $query = Estations::query();

        if ($selected_city) {
            $query->where('city', $selected_city);
        }

        if ($isOpen) {
            $now = Carbon::now();

            $query->where(function ($query) use ($now) {
                $query->whereTime('opening_hours', '<=', $now)
                    ->whereTime('closing_hours', '>=', $now)
                    ->orWhere(function ($query) use ($now) {
                        $query->whereTime('opening_hours', '>', $now)
                            ->whereTime('closing_hours', '<', $now);
                    });
            });
        }

        $estations = $query->get();

        if ($estations->count() == 0) {
            return back()->with('error', 'No stations in the city yet.');
        }

        return view('estations.show', [
            'estations' => $estations,
            'selected_city' => $selected_city
        ]);
    }

    public function getClosestOpen($latitude, $longitude)
    {
        $estations = Estations::all();
        $closestEstation = null;
        $minDistance = INF;

        foreach ($estations as $estation) {
            if ($estation->isOpen()) {
                $distance = Estations::haversine($latitude, $longitude, $estation->latitude, $estation->longitude);
                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $closestEstation = $estation;
                }
            }
        }

        $data = [
            'closestEstation' => $closestEstation ? json_decode($closestEstation->toJson()) : null,
            'distance' => $distance
        ];

        return view('closest-estation', $data);
    }

    public function search(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $validatedData = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ], [
            'latitude.required' => 'Please enter a latitude value.',
            'latitude.numeric' => 'The latitude must be a numeric value.',
            'latitude.between' => 'The latitude must be between -90 and 90.',
            'longitude.required' => 'Please enter a longitude value.',
            'longitude.numeric' => 'The longitude must be a numeric value.',
            'longitude.between' => 'The longitude must be between -180 and 180.',
        ]);


        return redirect()->route('estations.closest', ['latitude' => $latitude, 'longitude' => $longitude]);
    }

}

