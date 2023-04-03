<?php

use App\Http\Controllers\EstationsController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('main');
});

Route::get('/estations/show', [EstationsController::class, 'show'])->name('estations.show');

Route::get('/estations/create', [EstationsController::class, 'create'])->name('estations.create');
Route::post('/estations/store', [EstationsController::class, 'store'])->name('estations.store');

Route::get('/estations/{estation}/edit', [EstationsController::class, 'edit'])->name('estations.edit');
Route::post('/estations/{id}/update', [EstationsController::class, 'update'])->name('estations.update');
Route::put('/estations/{id}/update', [EstationsController::class, 'update'])->name('estations.update');

Route::delete('/estations/{id}', [EstationsController::class, 'destroy'])->name('estations.destroy');


Route::get('/estations/filter', [EstationsController::class, 'filter'])->name('estations.filter');


Route::get('/estations/city/{city}/open', [EstationsController::class, 'openByCity']);
Route::get('/estations/closest', [EstationsController::class, 'getClosestOpen']);


