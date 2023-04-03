<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;

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

        // If closing time is less than or equal to opening time, it means the station is open
        // after midnight and we need to add a day to the closing time
        if ($closingTime->lte($openingTime)) {
            $closingTime->addDay();
        }

        // If the station is open past midnight, check if the current time is between opening time and midnight,
        // or between midnight and closing time
        if ($closingTime->day > $openingTime->day) {
            $isBetweenMidnightAndClosingTime = $now->between(Carbon::createFromFormat('Y-m-d H:i', $closingTime->format('Y-m-d').' 00:00'), $closingTime);
            $isBetweenOpeningTimeAndMidnight = $now->between($openingTime, Carbon::createFromFormat('Y-m-d H:i', $openingTime->format('Y-m-d').' 23:59'));
            return $isBetweenMidnightAndClosingTime || $isBetweenOpeningTimeAndMidnight;
        }

        // If the station is open during the same day, check if the current time is between opening time and closing time
        return $now->between($openingTime, $closingTime);
    }

}
