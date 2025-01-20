<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/getUsers', ['App\Http\Controllers\MainController', 'getPeople']);
Route::get('/getUser/{id}', ['App\Http\Controllers\MainController', 'getUser']);
Route::post('/editUser/{id}', ['App\Http\Controllers\MainController', 'editUser']);
Route::delete('/deleteUser/{id}', ['App\Http\Controllers\MainController', 'deleteUser']);
