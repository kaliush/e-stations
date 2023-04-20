<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'opening_hours' => ['required', 'date_format:H:i'],
            'closing_hours' => ['required', 'date_format:H:i'],
        ];
    }
}
