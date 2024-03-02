<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;

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

/*Auth Routes*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

# Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    # Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('rooms',RoomController::class)->only('index', 'store', 'show');
    Route::apiResource('bookings',BookingController::class)->only('index', 'store');
    Route::apiResource('customers',CustomerController::class)->only('index', 'store');
    Route::apiResource('payments',PaymentController::class)->only( 'store');
});