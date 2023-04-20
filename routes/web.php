<?php

use App\Http\Controllers\StationController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('main');
});

Route::get('/show', [StationController::class, 'show'])->name('stations.show');

Route::get('/create', [StationController::class, 'create'])->name('stations.create');
Route::post('/store', [StationController::class, 'store'])->name('stations.store');

Route::get('/{id}/edit', [StationController::class, 'edit'])->name('stations.edit');

Route::get('/{id}/update', [StationController::class, 'update'])->name('stations.update');
Route::patch('/{id}/update', [StationController::class, 'update'])->name('stations.update');


Route::delete('/{id}/delete', [StationController::class, 'destroy'])->name('stations.delete');

Route::get('/nearest', [StationController::class, 'getNearestOpenStation'])->name('stations.nearest');




