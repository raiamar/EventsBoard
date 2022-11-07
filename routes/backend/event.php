<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\EventsController;

Route::controller(EventsController::class)->middleware('check_role')->prefix('admin')->group(function(){
    Route::get('event','EventList')->name('event');
    Route::get('create-event','CreateEvent')->name('create.event');
    Route::get('event/{id}','EditEvent')->name('edit.event');
    Route::post('event','ManageEvent')->name('manage.event');
    Route::get('participant/{id}', 'ParticipantDetails')->name('participants');
    Route::get('my-events', 'EventsDetails')->name('my.events');
});