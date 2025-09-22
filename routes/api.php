<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomizationController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AgendaController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('status', StatusController::class);


Route::apiResource('roles', RoleController::class);

Route::apiResource('plans', PlanController::class);


Route::apiResource('categories', CategoryController::class);

Route::apiResource('businesses', BusinessController::class);

Route::apiResource('users', UserController::class);

Route::apiResource('services', ServiceController::class);


Route::apiResource('customizations',CustomizationController::class);


Route::apiResource('appointments', AppointmentController::class);


Route::apiResource('agendas', AgendaController::class);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
