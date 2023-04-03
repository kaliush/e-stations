<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class Estations extends Model
{
    use HasFactory;

    protected $table = 'estations';

    protected $fillable = [
        'name',
        'city',
        'address',
        'latitude',
        'longitude',
        'opening_hours',
        'closing_hours'
    ];

    public static function create(array $validatedData)
    {
        return self::query()->create($validatedData);
    }

    public static function find($id)
    {
        return self::where('id', $id)->first();
    }

    public static function findOrFail($id)
    {
        $estation = self::find($id);

        if (!$estation) {
            throw new ModelNotFoundException('E-station not found');
        }
        return $estation;
    }

    public function isOpen()
    {
        if ($this->opening_hours === null || $this->closing_hours === null) {
            return false;
        }
        $now = Carbon::now();
        $openingTime = Carbon::createFromFormat('H:i', $this->opening_hours);
        $closingTime = Carbon::createFromFormat('H:i', $this->closing_hours);

        if ($closingTime < $openingTime) {
            // If closing time is less than opening time, it means the station is open
            // after midnight and we need to add a day to the closing time
            $closingTime->addDay();
        }

        $isOpen = $now->between($openingTime, $closingTime);

        // Debug information
        Log::debug('isOpen() called for station ' . $this->id);
        Log::debug('Opening time: ' . $openingTime->format('H:i'));
        Log::debug('Closing time: ' . $closingTime->format('H:i'));
        Log::debug('Current time: ' . $now->format('H:i'));
        Log::debug('Is open? ' . ($isOpen ? 'Yes' : 'No'));

        return $isOpen;
    }


}
