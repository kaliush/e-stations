<?php

namespace App\Services;

use App\Http\Requests\CreateStationRequest;
use App\Http\Requests\UpdateStationRequest;
use App\Models\Station;
use App\Repositories\StationRepository;
use Illuminate\Database\Eloquent\Collection;


readonly class StationService
{
    public function __construct(private StationRepository $repository)
    {
    }


    public function create(CreateStationRequest $request): ?Station
    {
        $data = $request->validatedDto();

        return $this->repository->create($data);
    }

    public function update(UpdateStationRequest $request, Station $station): bool
    {
        $data = $request->toDto();

        return $this->repository->update($station, $data);
    }

    public function delete(Station $station): bool
    {
        return $this->repository->delete($station);
    }

    public function getById(int $id): ?Station
    {
        return $this->repository->getById($id);
    }

    public function getStations(?string $city = null, ?bool $isOpen = null): Collection
    {
        if ($city !== null && $isOpen !== null) {
            $stations = $this->repository->getOnlyOpenByCity($city);
        } elseif ($city !== null) {
            $stations = $this->repository->getByCity($city);
        } elseif ($isOpen !== null) {
            $stations = $this->repository->getOnlyOpen();
        } else {
            $stations = $this->repository->getAll();
        }

        return $stations;
    }

    public function findNearestOpenStation(float $latitude, float $longitude): ?Station
    {
        $stations = $this->repository->getOnlyOpen();
        $nearestStation = null;
        $minDistance = null;

        foreach ($stations as $station) {

            $distance = $this->calculateDistance($latitude, $longitude, $station->latitude, $station->longitude);

            if ($minDistance === null || $distance < $minDistance) {
                $minDistance = $distance;
                $nearestStation = $station;
            }
        }

        return $nearestStation;
    }

    private function calculateDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $theta = $lon1 - $lon2;
        $distance = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        return $distance * 1.609344;
    }
}
