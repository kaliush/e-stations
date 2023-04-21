<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Stations
 *
 * @property int $id
 * @property string $name
 * @property string $city
 * @property string $address
 * @property float $latitude
 * @property float $longitude
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $opening_hours
 * @property string|null $closing_hours
 * @method static \Database\Factories\StationsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Station newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Station newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Station query()
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereClosingHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereOpeningHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Station whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Station extends Model
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

    public function isOpen(): bool
    {
        if ($this->opening_hours === null || $this->closing_hours === null) {
            return false;
        }

        $now = Carbon::now();
        $openingTime = Carbon::createFromFormat('H:i', $this->opening_hours);
        $closingTime = Carbon::createFromFormat('H:i', $this->closing_hours);

        // If closing time is less than or equal to opening time, it means the station is open
        // after midnight, and we need to add a day to the closing time
        if ($closingTime->lte($openingTime)) {
            $closingTime->addDay();
        }

        // If the station is open past midnight, check if the current time is between opening time and midnight,
        // or between midnight and closing time
        if ($closingTime->day > $openingTime->day) {
            $isBetweenMidnightAndClosingTime = $now->between(Carbon::createFromFormat('Y-m-d H:i', $closingTime->format('Y-m-d') . ' 00:00'), $closingTime);
            $isBetweenOpeningTimeAndMidnight = $now->between($openingTime, Carbon::createFromFormat('Y-m-d H:i', $openingTime->format('Y-m-d') . ' 23:59'));
            return $isBetweenMidnightAndClosingTime || $isBetweenOpeningTimeAndMidnight;
        }

        // If the station is open during the same day, check if the current time is between opening time and closing time
        return $now->between($openingTime, $closingTime);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

}
