<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\PasswordController;
use App\Http\Controllers\User\UserDashboardController;

//user
Route::group(["prefix" => 'user', 'middleware' => 'user'], function(){
    Route::get('/home',[UserDashboardController::class, 'index'])->name('userDashboard');

    //profile
    Route::get('profile/{id}',[ProfileController::class, 'profile'])->name('profile');
    Route::get('profile/details/{id}',[ProfileController::class, 'profileDtails'])->name('userProfileDetails');
    Route::post('profile/update',[ProfileController::class, 'userprofileUpdate'])->name('userprofileUpdate');

    //change pw
    Route::get('changePassword',[PasswordController::class, 'changeUserPassword'])->name('changeUserPassword');
    Route::post('changePassword',[PasswordController::class, 'userChangePassword'])->name('userChangePassword');

    //shop
    Route::get('/shop/{category_id?}',[ShopController::class, 'shop'])->name('shopList');
    Route::get('/details/{id}',[ShopController::class, 'details'])->name('shopDetails');

    //cmt and rating
    Route::post('comment',[ShopController::class, 'comment'])->name('comment');
    Route::post('addRating', [ShopController::class, 'addRating'])->name('addRating');

    //cart
    Route::get('cart', [ShopController::class, 'cart'])->name('cart');
    Route::post('addToCart', [ShopController::class, 'addToCart'])->name('addToCart');
    Route::get('remove/cart', [ShopController::class, 'removeCart'])->name('removeCart');

    //order
    Route::get('order', [ShopController::class, 'order'])->name('order');
    Route::get('orderList', [ShopController::class, 'orderList'])->name('orderList');

    //payment
    Route::get('payment', [ShopController::class, 'payment'])->name('payment');
    Route::post('prder/product',[ShopController::class, 'orderProduct'])->name('orderProduct');

    // contact
    Route::get('contact/page', [ContactController::class, 'userContact'])->name('userContact');
    Route::post('contact/page', [ContactController::class, 'contact'])->name('contact');
    Route::get('contact/list', [ContactController::class, 'contactList'])->name('contactList');
    Route::get('contact/reply/{id}', [ContactController::class, 'contactReply'])->name('contactReply');
});
