<?php

namespace App\Services;

use App\Dto\CreateStationDto;
use App\Dto\UpdateStationDto;
use App\Http\Requests\CreateStationRequest;
use App\Http\Requests\UpdateStationRequest;
use App\Models\Station;
use App\Repositories\StationRepository;
use Illuminate\Database\Eloquent\Collection;


class StationService
{
    private StationRepository $repository;

    public function __construct(StationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(CreateStationRequest $request): ?Station
    {
        $data = new CreateStationDto($request->validated());

        return $this->repository->create($data);
    }

    public function update(UpdateStationRequest $request, Station $station): bool
    {
        $data = new UpdateStationDto($request->validated());

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

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function getByCity(string $city): Collection
    {
        return $this->repository->getByCity($city);
    }

    public function getOnlyOpen(): Collection
    {
        return $this->repository->getOnlyOpen();
    }

    public function getOnlyOpenByCity(string $city): Collection
    {
        return $this->repository->getOnlyOpenByCity($city);
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
        $distance = $distance * 1.609344;

        return $distance;
    }
}
