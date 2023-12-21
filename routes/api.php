<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::post('/login/player', [AuthController::class, 'playerLogin']);
Route::post('/login/club_manager', [AuthController::class, 'clubManagerLogin']);
Route::post('/signup/player', [AuthController::class, 'playerSignup']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/reservations', [ReservationController::class, 'index']);


Route::post('/signup', [AuthController::class, 'signup']);


Route::post('/upload-image', [ImageController::class, 'upload']);
