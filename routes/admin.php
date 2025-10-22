<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\Admin\RoleController; // <-- AÑADE ESTA LÍNEA

Route::get('/', function () {
    return view(('admin.dashboard'));
})->name('dashboard');

// Gestión de usuarios
Route::resource('roles', RoleController::class);
=======

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
