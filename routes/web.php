<?php

use App\Http\Controllers\Web\AuthController as WebAuthController;
use App\Http\Controllers\Web\EventController as WebEventController;
use App\Http\Controllers\Web\ParticipantController as WebParticipantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');

    Route::resource('events.participants', WebParticipantController::class)->scoped()->except('update');
});

Route::get('/login', [WebAuthController::class, 'showLoginPage'])->name('login');
Route::post('/login', [WebAuthController::class, 'login'])->name('login.store');

Route::resource('events', WebEventController::class);
