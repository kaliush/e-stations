<?php

namespace App\Http\Controllers;

    use App\Http\Requests\CreateStationRequest;
    use App\Http\Requests\NearestOpenStationRequest;
    use App\Http\Requests\ShowStationRequest;
    use App\Http\Requests\UpdateStationRequest;
    use App\Models\Station;
    use App\Services\StationService;
    use Exception;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Support\Facades\Log;
    use Illuminate\View\View;

class StationController extends Controller
{
    public function show(ShowStationRequest $request, StationService $stationService): View
    {
        $stations = $stationService->getStations(
            city: $request->input('city'),
            isOpen: $request->input('isOpen')
        );

        return view('stations.show', compact('stations'));
    }

    public function create(): View
    {
        return view('stations.create');
    }

    public function store(CreateStationRequest $request, StationService $stationService): RedirectResponse
    {
        $station = $stationService->create($request);

        if ($station) {
            return redirect()->route('stations.show', $station->id)->with('success', 'Station created successfully.');
        } else {
            return back()->withInput()->withErrors(['Unable to create station.']);
        }
    }

    public function edit(int $id, StationService $stationService)
    {
        try {
            $station = $stationService->getById($id);
            return view('stations.edit', compact('station'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('stations.show')->with('error', 'There was an error editing the station.');
        }
    }

    public function update($id, UpdateStationRequest $request, StationService $stationService): RedirectResponse
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

    public function destroy($id): RedirectResponse
    {
        $station = Station::findOrFail($id);
        $station->delete();

        return redirect()->route('stations.show')
            ->with('success', 'Station has been deleted.');
    }

    public function nearestOpen(NearestOpenStationRequest $request, StationService $stationService)
    {
        $station = $stationService->findNearestOpenStation(
            latitude: $request->input('latitude'),
            longitude: $request->input('longitude')
        );

        if (!$station) {
            return redirect()->back()
                ->withErrors(['message' => 'No open stations found.'])
                ->withInput();
        }

        return view('stations.nearest-open', compact('station'));
    }
}


