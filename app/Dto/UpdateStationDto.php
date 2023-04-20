<?php

namespace App\Dto;

class UpdateStationDto
{
    public string $name;
    public string $city;
    public string $address;
    public float $latitude;
    public float $longitude;
    public ?string $opening_hours;
    public ?string $closing_hours;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->city = $data['city'];
        $this->address = $data['address'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
        $this->opening_hours = $data['opening_hours'] ?? null;
        $this->closing_hours = $data['closing_hours'] ?? null;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string|null
     */
    public function getOpeningHours(): ?string
    {
        return $this->opening_hours;
    }

    /**
     * @param string|null $opening_hours
     */
    public function setOpeningHours(?string $opening_hours): void
    {
        $this->opening_hours = $opening_hours;
    }

    /**
     * @return string|null
     */
    public function getClosingHours(): ?string
    {
        return $this->closing_hours;
    }

    /**
     * @param string|null $closing_hours
     */
    public function setClosingHours(?string $closing_hours): void
    {
        $this->closing_hours = $closing_hours;
    }


}

