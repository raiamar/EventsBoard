<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardRouteController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AdvertismentController;
use App\Http\Controllers\Backend\CategoryController;


Route::controller(CategoryController::class)->group(function(){

    Route::group(['prefix'=>'admin', 'middleware'=>'check_role'], function(){
        Route::get('category','CategoryList')->name('category');
        Route::get('create-category','CreateCategory')->name('create.category');
        Route::get('category/{id}','EditCategory')->name('edit.category');
        Route::post('category','ManageCategory')->name('manage.category');
    });

});


Route::controller(DashboardRouteController::class)->group(function(){
    Route::get('contact-list','ContactList')->name('contact.list');
    Route::get('mark-as-read/{id}', 'MarkAaRead')->name('contact.mark.as.read');
    Route::group(['prefix'=>'admin', 'middleware'=>'check_role'], function(){
        Route::get('dashboard', 'Dashboard')->name('dashboard');
    });

    Route::group(['prefix'=>'admin', 'middleware'=>'super_admin'], function(){
        Route::get('about-us','AboutUs')->name('about.us');
        Route::post('about-us','ManageAboutUs')->name('manage.about.us');


        Route::get('testimonial','TestimonialList')->name('testimonial');
        Route::get('create-testimonial','CreateTestimonial')->name('create.testimonial');
        Route::get('testimonial/{id}','EditTestimonal')->name('edit.testimonial');
        Route::post('testimonial','ManageTestimonal')->name('manage.testimonial');
    });
});


Route::controller(UserController::class)->group(function(){
    Route::group(['prefix'=>'dashboard', 'middleware'=>'super_admin'], function(){
        Route::get('user-list','user_list')->name('get.user.list');
        Route::get('create-vendor','create_vendor')->name('get.vendor.form');
        Route::get('vendor-list','vendor_list')->name('get.vendor.list');
        Route::post('register-vendor', 'register_vendor')->name('register.vendor');
        Route::get('vender-request-list', 'VendorRequestList')->name('vendor.request.list');
        Route::get('confirm-vender-request/{id}', 'ConfirmVendorRequest')->name('confirm.vendor.request');

    });
});


Route::resource('adds', AdvertismentController::class)->middleware('super_admin');
