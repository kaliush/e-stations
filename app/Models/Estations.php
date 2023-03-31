<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        'is_open',
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
}
