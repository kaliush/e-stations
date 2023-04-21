<?php

namespace App\Dto;

class CreateStationDto
{
    public function __construct(
        public string $name,
        public string $city,
        public string $address,
        public float $latitude,
        public float $longitude,
        public ?string $opening_hours = null,
        public ?string $closing_hours = null,
    ) {}
}
