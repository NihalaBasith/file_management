<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[AuthController::class, 'ShowRegistrationForm'])->name('register');
Route::post('/register',[AuthController::class, 'Register']);
Route::get('/dashboard', [AuthController::class, 'DashboardIndex'])->name('dashboard');
Route::get('/login',[AuthController::class, 'ShowLoginForm'])->name('login');
Route::post('/login',[AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/fileUpload',[FileController::class, 'FileUploadForm'])->name('fileUpload');
Route::post('/upload',[FileController::class, 'upload']);
Route::get('/upload',[FileController::class, 'upload']);
Route::delete('/files/delete/{id}', [FileController::class, 'delete'])->name('files.delete');
Route::get('/fileRename/{id}',[FileController::class, 'fileRenameForm'])->name('fileRename');
Route::post('file/rename/{id}',[FileController::class, 'rename'])->name('file.rename');
// Route::get('file/rename/{id}',[FileController::class, 'rename']);





