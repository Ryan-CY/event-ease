<?php

use App\Http\Controllers\Web\EventController as WebEventController;
use App\Http\Controllers\Web\ParticipantController as WebParticipantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('events', WebEventController::class);
Route::resource('events.participants', WebParticipantController::class)->scoped()->except('update');