<?php

namespace App\Http\Requests;

use App\Dto\UpdateStationDto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStationRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'city' => 'required|max:255',
            'address' => 'required|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'opening_hours' => 'required|date_format:H:i',
            'closing_hours' => 'required|date_format:H:i',
        ];
    }

    public function toDto(): UpdateStationDto
    {
        return new UpdateStationDto(
            name: $this->input('name'),
            city: $this->input('city'),
            address: $this->input('address'),
            latitude: $this->input('latitude'),
            longitude: $this->input('longitude'),
            opening_hours: $this->input('opening_hours'),
            closing_hours: $this->input('closing_hours')
        );
    }
}
