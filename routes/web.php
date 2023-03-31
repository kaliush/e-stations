<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('main');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/estations', 'EstationsController@index')->name('estations.index'); //show all
Route::get('/estations/create', 'EstationsController@create')->name('estations.create'); //create new
Route::get('/estations/{id}/edit', 'EstationsController@edit')->name('estations.edit'); //edit existing
Route::delete('/estations/{id}', 'EstationsController@destroy')->name('estations.destroy'); //delete
Route::get('/estations/city/{city}', 'EstationsController@getByCity')->name('estations.byCity'); //get in city
Route::get('/estations/city/{city}/open', 'EstationsController@getOpenByCity')->name('estations.openByCity');
Route::get('/estations/closest', 'EstationsController@getClosestOpen')->name('estations.closestOpen');


