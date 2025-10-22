<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\Admin\RoleController; // <-- AÑADE ESTA LÍNEA

Route::get('/', function () {
    return view(('admin.dashboard'));
})->name('dashboard');

// Gestión de usuarios - COMENTA O ELIMINA ESTA LÍNEA
// Route::resource('roles', RoleController::class);

// --- Rutas de prueba (puedes borrarlas si ya no las necesitas) ---

// Ruta para verificar el idioma actual
Route::get('/check-locale', function () {
    return app()->getLocale();
});

// Ruta para verificar traducciones
Route::get('/check-translation', function () {
    return __('auth.failed');
});
=======

Route::redirect('/', '/admin');
// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
