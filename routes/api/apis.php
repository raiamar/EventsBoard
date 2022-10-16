<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApisController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\ParticipantController;

Route::group(['prefix'=>'v1'], function (){

    Route::controller(ApisController::class)->group(function(){
        Route::get('advertisment-list', 'GetAdvertisment');
        Route::post('contact-request', 'ContactReceived');
        Route::get('about-us', 'AboutUs');
    });

    Route::get('event-list', [EventController::class, 'GetEvent']);
    Route::get('pre-booking', [EventController::class,'EventsPreBookingList']);
    Route::post('pre-booking', [EventController::class,'PreBookings']);

    Route::controller(EventController::class)->middleware(['auth:sanctum', 'check_role'])->group(function(){
        Route::post('create-event', 'CreateEvent');
        Route::post('update-event', 'UpdateEvent');
        Route::get('edit-event/{id}', 'EditEvent');
        Route::get('pre-booking-list', 'PreBookingList');
    });

    Route::controller(ParticipantController::class)->group(function(){
        Route::post('receive-participant-form', 'ReceiveParticipantForm');
    });

});

// middleware('super_admin')