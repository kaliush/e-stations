<?php

namespace App\Dto;

class UpdateStationDto
{
    public function __construct(
        public ?string $name = null,
        public ?string $city = null,
        public ?string $address = null,
        public ?float $latitude = null,
        public ?float $longitude = null,
        public ?string $opening_hours = null,
        public ?string $closing_hours = null,
    ) {}
}


