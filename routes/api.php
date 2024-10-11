<?php

use App\Http\Controllers\Api\ConsultationApiController;
use App\Http\Controllers\Api\DoctorApiController;
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


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/consultationsApi', [ConsultationApiController::class, 'consultationsApi']);
    Route::get('/doctorsApi', [DoctorApiController::class, 'doctorsApi']);
    Route::post('/consultations/update', [ConsultationApiController::class, 'update']);
    Route::post('/consultations/create', [ConsultationApiController::class, 'create']);
});
