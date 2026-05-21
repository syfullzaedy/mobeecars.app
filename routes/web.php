<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CarController;

Route::get('/', [AdminController::class, 'getDashboard'])->name('dashboard');

Route::get('/users', [UserController::class, 'getUsers'])->name('get_users');
Route::get('/user/{id}', [UserController::class, 'getUser'])->name('get_user');
Route::get('/users/add', [UserController::class, 'addUser'])->name('add_user');
Route::post('/users/add', [UserController::class, 'saveUser'])->name('save_user');
Route::get('/users/edit/{id}', [UserController::class, 'editUser'])->name('edit_user');
Route::delete('/users/delete', [UserController::class, 'deleteUser'])->name('delete_user');

Route::get('/cars', [CarController::class, 'getCars'])->name('get_cars');
Route::get('/cars/add', [CarController::class, 'addCar'])->name('add_car');
Route::post('/cars/add', [CarController::class, 'saveCar'])->name('save_car');
Route::get('/cars/edit/{id}', [CarController::class, 'editCar'])->name('edit_car');
Route::delete('/cars/delete', [CarController::class, 'deleteCar'])->name('delete_car');

Route::get('/reports', [AdminController::class, 'getReports'])->name('get_reports');

Route::get('/login', [AdminController::class, 'getLogin'])->name('get_login');
Route::post('/login', [AdminController::class, 'postLogin'])->name('post_login');
Route::get('/logout', [AdminController::class, 'logOut'])->name('logout');
