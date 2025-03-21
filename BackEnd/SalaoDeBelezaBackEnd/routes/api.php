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
//Login 
Route::post('/users/login', [UserController::class, 'login_user']);
//Users 
Route::get('/users', [UserController::class, 'index'])->name('api.users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('api.users.show');
Route::put('/users/{id}', [UserController::class, 'update'])->name('api.users.update');
Route::post('/users', [UserController::class, 'create'])->name('api.users.create');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('api.users.destroy');

//Appointments - Agendamentos
Route::get('/appointments', [AppointmentsController::class, 'index'])->name('api.appointments.index');

Route::post('/appointments', [AppointmentsController::class, 'create'])->name('api.appointments.create');


//Services - Serviços

Route::get('/services', [ServicesController::class, 'index'])->name('api.services.index');
Route::post('/services', [ServicesController::class, 'create'])->name('api.services.create');
