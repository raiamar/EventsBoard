<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PaymentController;


Route::controller(PaymentController::class)->prefix('v1')->group(function(){

    Route::any('success', 'EsewaSuccess');
    Route::any('fail', 'EsewaFail');
    Route::get('payment-response', 'esewa_payment_response');

});

