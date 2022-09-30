<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;


Route::group(['prefix'=>'v1', 'as'=>'api.'], function (){

    Route::controller(UserController::class)->group(function (){
        Route::post('login', 'login')->name('login');
        Route::middleware('auth:sanctum')->post('logout', 'logout');
        Route::middleware('auth:sanctum')->get('user-details/{id}', 'user_detail');
        Route::middleware('auth:sanctum')->post('make-vendor-request', 'make_vendor_request');
        Route::post('register', 'register')->name('register');
    });

    
    Route::controller(UserController::class)->middleware('super_admin')->group(function(){
        //
    });

});