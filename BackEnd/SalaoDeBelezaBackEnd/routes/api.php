<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Users 
Route::post('/users/login', [UserController::class, 'login_user']);
Route::get('/users', [UserController::class, 'index'])->name('api.users.index');
Route::put('/users/{id}', [UserController::class, 'update'])->name('api.users.update');
Route::post('/users', [UserController::class, 'create'])->name('api.users.create');


//Appointments - Agendamentos
Route::get('/appointments', [AppointmentsController::class, 'index'])->name('api.appointments.index');

Route::post('/appointments', [AppointmentsController::class, 'create'])->name('api.appointments.create');


//Services - Serviços

Route::get('/services', [ServicesController::class, 'index'])->name('api.services.index');
Route::post('/services', [ServicesController::class, 'create'])->name('api.services.create');
