<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStationRequest;
use App\Http\Requests\NearestOpenStationRequest;
use App\Http\Requests\ShowStationRequest;
use App\Http\Requests\UpdateStationRequest;
use App\Models\Station;
use App\Services\stationService;
use Exception;
use Illuminate\Support\Facades\Log;


class StationController extends Controller
{

    public function show(ShowStationRequest $request, StationService $stationService)
    {
        $city = $request->input('city');
        $isOpen = $request->input('isOpen');

        if ($city !== null && $isOpen !== null) {
            $stations = $stationService->getOnlyOpenByCity($city);
        } elseif ($city !== null) {
            $stations = $stationService->getByCity($city);
        } elseif ($isOpen !== null) {
            $stations = $stationService->getOnlyOpen();
        } else {
            $stations = $stationService->getAll();
        }

        return view('stations.show', ['stations' => $stations]);
    }

    public function create()
    {
        return view('stations.create');
    }

    public function store(CreateStationRequest $request, StationService $stationService)
    {
        $station = $stationService->create($request);

        if ($station) {
            return redirect()->route('stations.show', $station->id)->with('Station created successfully.');
        } else {
            return back()->withInput()->withErrors(['Unable to create station.']);
        }
    }

    public function edit($id, StationService $stationService)
    {
        try {
            $station = $stationService->getById($id);
            return view('stations.edit', ['station' => $station]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect('/show')->with('error', 'There was an error editing the station.');
        }
    }

    public function update($id, UpdateStationRequest $request, StationService $stationService)
    {
        $station = $stationService->getById($id);
        if (!$station) {
            return redirect()->route('stations.show')->withErrors(['error' => 'Station not found']);
        }

        $success = $stationService->update($request, $station);
        if (!$success) {
            return redirect()->back()->withErrors(['error' => 'Failed to update station']);
        }

        return redirect()->route('stations.show')->with('success', 'Station updated successfully');
    }

    public function destroy($id)
    {
        $station = Station::findOrFail($id);
        $station->delete();

        return redirect()->route('stations.show')
            ->with('success', 'Station has been deleted.');
    }

    public function getNearestOpenStation(NearestOpenStationRequest $request, StationService $stationService)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $station = $stationService->findNearestOpenStation($latitude, $longitude);

        if (!$station) {
            return redirect()->back()
                ->withErrors(['message' => 'No open stations found.'])
                ->withInput();
        }

        return view('stations.nearest-open', compact('station'));
    }
}

