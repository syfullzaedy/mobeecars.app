<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CarController;

Route::get('/user', [UserController::class, 'index'])->name('home');
Route::post('/user', [UserController::class, 'postLogin'])->name('login');
Route::post('/likes', [UserController::class, 'getLikes'])->name('likes');
Route::post('/online', [UserController::class, 'postInteraction'])->name('online_interaction');

Route::get('/cars', [CarController::class, 'getCars'])->name('cars');
Route::get('/stats', [CarController::class, 'getStats'])->name('stats');
Route::get('/stats/{id}', [CarController::class, 'getStatsByUser'])->name('stat');
