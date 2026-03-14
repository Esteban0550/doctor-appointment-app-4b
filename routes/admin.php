<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController; // <-- AÑADE ESTA LÍNEA
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\AppointmentController;

Route::get('/', function () {
    return view(('admin.dashboard'));
})->name('dashboard');

// Gestión de usuarios
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('patients', PatientController::class);
Route::resource('doctors', DoctorController::class);
Route::get('doctors/{doctor}/schedules', [DoctorController::class, 'schedules'])->name('doctors.schedules');

Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('appointments/{appointment}/consultation', [AppointmentController::class, 'consultation'])->name('appointments.consultation');

// Calendario (módulo de agenda simple, sin lógica aún)
Route::view('calendar', 'admin.calendar.index')->name('calendar.index');
