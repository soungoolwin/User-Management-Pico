<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('components.dashboard');
})->name('dashboard');

Route::get('/dashboard/login', [AuthController::class, 'index'])->name('login');
Route::post('/dashboard/login', [AuthController::class, 'login']);
Route::post('/dashboard/signout', [AuthController::class, 'signout'])->name('logout');


Route::resource('/dashboard/users', UserController::class);

Route::resource('/dashboard/roles', RoleController::class);
