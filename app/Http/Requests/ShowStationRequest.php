<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowStationRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'city' => 'nullable|string',
            'isOpen' => 'nullable|boolean'
        ];
    }

}
