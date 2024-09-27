<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[AuthController::class, 'ShowRegistrationForm'])->name('register');
Route::post('/register',[AuthController::class, 'Register']);
Route::get('/dashboard', [AuthController::class, 'DashboardIndex'])->name('dashboard');
Route::get('/login',[AuthController::class, 'ShowLoginForm'])->name('login');
Route::post('/login',[AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');