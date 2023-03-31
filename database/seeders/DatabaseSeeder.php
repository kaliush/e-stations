<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('estations')->insert([
            [
                'name' => 'Station 1',
                'city' => 'Kyiv',
                'address' => '123 Main Street',
                'latitude' => 50.4409,
                'longitude' => 30.4966,
                'is_open' => true
            ],
            [
                'name' => 'Station 2',
                'city' => 'Lviv',
                'address' => '456 Elm Street',
                'latitude' => 49.8397,
                'longitude' => 24.0297,
                'is_open' => false
            ],
            [
                'name' => 'E-Station Kiev 1',
                'city' => 'Kyiv',
                'address' => 'Volodymyrska St, 47',
                'lat' => '50.4477',
                'lng' => '30.5240',
                'is_open' => true,
            ],
            [
                'name' => 'E-Station Kiev 2',
                'city' => 'Kyiv',
                'address' => 'Bohdana Khmelnytskoho St, 40',
                'lat' => '50.4445',
                'lng' => '30.4982',
                'is_open' => false,
            ],
            [
                'name' => 'E-Station Kiev 3',
                'city' => 'Kyiv',
                'address' => 'Hrushevskoho St, 1',
                'lat' => '50.4427',
                'lng' => '30.5360',
                'is_open' => true,
            ],
            [
                'name' => 'E-Station Lviv 1',
                'city' => 'Lviv',
                'address' => 'Mitskevycha Square, 4',
                'lat' => '49.8397',
                'lng' => '24.0297',
                'is_open' => true,
            ],
            [
                'name' => 'E-Station Lviv 2',
                'city' => 'Lviv',
                'address' => 'Vynnychenka St, 32',
                'lat' => '49.8418',
                'lng' => '24.0345',
                'is_open' => false,
            ],
            [
                'name' => 'E-Station Lviv 3',
                'city' => 'Lviv',
                'address' => 'Kryvonosa St, 8',
                'lat' => '49.8334',
                'lng' => '24.0155',
                'is_open' => true,
            ],
            [
                'name' => 'E-Station Odessa 1',
                'city' => 'Odessa',
                'address' => 'Rishelievska St, 17',
                'lat' => '46.4837',
                'lng' => '30.7393',
                'is_open' => true,
            ],
            [
                'name' => 'E-Station Odessa 2',
                'city' => 'Odessa',
                'address' => 'Gretska St, 1',
                'lat' => '46.4687',
                'lng' => '30.7489',
                'is_open' => false,
            ],
            [
                'name' => 'E-Station Odessa 3',
                'city' => 'Odessa',
                'address' => 'Sichovykh Striltsiv St, 60',
                'lat' => '46.4836',
                'lng' => '30.7383',
                'is_open' => true,
            ]
        ]);
    }
}
