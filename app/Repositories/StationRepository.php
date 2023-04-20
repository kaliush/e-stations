<?php
namespace App\Repositories;

use App\Dto\CreateStationDto;
use App\Dto\UpdateStationDto;
use App\Models\Station;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StationRepository
{
    public function findById(int $id): ?Station
    {
        return Station::find($id);
    }

    public function create(CreateStationDto $data): ?Station
    {
        return Station::create([
            'name' => $data->name,
            'city' => $data->city,
            'address' => $data->address,
            'latitude' => $data->latitude,
            'longitude' => $data->longitude,
            'opening_hours' => $data->opening_hours,
            'closing_hours' => $data->closing_hours,
        ]);
    }

    public function update(Station $station, UpdateStationDto $data): bool
    {
        $station->name = $data->name;
        $station->city = $data->city;
        $station->address = $data->address;
        $station->latitude = $data->latitude;
        $station->longitude = $data->longitude;
        $station->opening_hours = $data->opening_hours;
        $station->closing_hours = $data->closing_hours;

        return $station->save();
    }


    public function delete(Station $station): bool
    {
        return $station->delete();
    }

    public function getById(int $id): ?Station
    {
        $station = Station::find($id);

        if (!$station) {
            throw new ModelNotFoundException('Station not found');
        }

        return $station;
    }

    public function getAll(): Collection
    {
        return Station::all();
    }

    public function getByCity(string $city): Collection
    {
        return Station::where('city', $city)->get();
    }

    public function getOnlyOpen(): Collection
    {
        return Station::all()->filter(function ($station) {
            return $station->isOpen();
        });
    }

    public function getOnlyOpenByCity(string $city): Collection
    {
        return Station::where('city', $city)
            ->get()
            ->filter(fn($station) => $station->isOpen());
    }

}
