<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController as ApiEventController;
use App\Http\Controllers\Api\ParticipantController as ApiParticipantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', fn(Request $request) => $request->user());
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('events', ApiEventController::class);
Route::apiResource('events.participants', ApiParticipantController::class)->scoped()->except('update');