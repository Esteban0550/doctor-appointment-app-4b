<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
<<<<<<< HEAD
=======

>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
