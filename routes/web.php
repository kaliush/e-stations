<?php

use App\Http\Controllers\EstationsController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('main');
});

Route::get('/estations/index', [EstationsController::class, 'index']); //show all

Route::get('/estations/create', [EstationsController::class, 'create'])->name('estations.create'); //create new
Route::post('/estations/store', [EstationsController::class, 'store'])->name('estations.store');

Route::get('/estations/{id}/edit', [EstationsController::class, 'edit']); //edit existing
Route::post('/estations/{id}/update', [EstationsController::class, 'update'])->name('estations.update'); //update the database

Route::delete('/estations/{id}', [EstationsController::class, 'destroy']); //delete

Route::get('/estations/city/{city}', [EstationsController::class, 'getByCity']); //get in city
Route::get('/estations/city/{city}/open', [EstationsController::class, 'openByCity']);
Route::get('/estations/closest', [EstationsController::class, 'getClosestOpen']);


