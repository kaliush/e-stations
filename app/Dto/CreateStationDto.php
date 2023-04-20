<?php

namespace App\Dto;

class CreateStationDto
{
    public string $name;
    public string $city;
    public string $address;
    public float $latitude;
    public float $longitude;
    public string $opening_hours;
    public string $closing_hours;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->city = $data['city'];
        $this->address = $data['address'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
        $this->opening_hours = $data['opening_hours'];
        $this->closing_hours = $data['closing_hours'];
    }
}
