<?php

use App\Http\Controllers\EstationsController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('main');
});

Route::get('/estations/index', [EstationsController::class, 'index'])->name('estations.index'); //show all

Route::get('/estations/create', [EstationsController::class, 'create'])->name('estations.create'); //create new
Route::post('/estations/store', [EstationsController::class, 'store'])->name('estations.store');

Route::get('/estations/{estation}/edit', [EstationsController::class, 'edit'])->name('estations.edit'); //edit existing
Route::post('/estations/{id}/update', [EstationsController::class, 'update'])->name('estations.update'); //update the database
Route::put('/estations/{id}/update', [EstationsController::class, 'update'])->name('estations.update');

Route::delete('/estations/{id}', [EstationsController::class, 'destroy'])->name('estations.destroy');


Route::get('/estations/city/{city}', [EstationsController::class, 'getByCity']); //get in city
Route::get('/estations/city/{city}/open', [EstationsController::class, 'openByCity']);
Route::get('/estations/closest', [EstationsController::class, 'getClosestOpen']);


