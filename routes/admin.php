<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ReplyController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderBoardController;
use App\Http\Controllers\Admin\RoleChangeController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SalesInformationController;

//admin
Route::group(["prefix" => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/home', [AdminDashboardController::class, 'index'])->name('adminDashboard');

    //category
    Route::prefix('category')->group(function () {
        Route::get('list', [CategoryController::class, 'list'])->name('categoryList');
        Route::get('create', [CategoryController::class, 'createPage'])->name('categoryCreatePage');
        Route::post('create', [CategoryController::class, 'create'])->name('categoryCreate');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('categoryDelete');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('categoryEdit');
        Route::post('update', [CategoryController::class, 'update'])->name('categoryUpdate');
        //if use Route::delete(get put push) -> only works with form
    });

    //product
    Route::prefix('product')->group(function () {
        Route::get('list', [ProductController::class, 'list'])->name('productList');
        Route::get('create', [ProductController::class, 'createPage'])->name('productCreatePage');
        Route::post('create', [ProductController::class, 'create'])->name('productCreate');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('productEdit');
        Route::post('update', [ProductController::class, 'update'])->name('productUpdate');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('productDelete');
        Route::get('details/{id}', [ProductController::class, 'details'])->name('productDetails');
    });

    //password
    Route::prefix('password')->group(function () {
        Route::get('change', [AuthController::class, 'passwordChange'])->name('passwordChange');
        Route::post('change', [AuthController::class, 'changePassword'])->name('changePassword');
    });

    //profile
    Route::prefix('profile')->group(function () {
        Route::get('detail', [ProfileController::class, 'profileDetails'])->name('profileDetails');
        Route::post('update', [ProfileController::class, 'update'])->name('profileUpdate');
        Route::get('create/adminAccount', [ProfileController::class, 'createAdminAccount'])->name('createAdminAccount');
        Route::post('create/adminAccount', [ProfileController::class, 'create'])->name('AdminCreate');
        Route::get('account/{id}', [ProfileController::class, 'accountProfile'])->name('accountProfile');
    });

    Route::prefix('role')->group(function () {
        Route::get('adminList', [RoleChangeController::class, 'adminList'])->name('adminList');
        Route::get('deleteAdminAccount/{id}', [RoleChangeController::class, 'deleteAdminAccount'])->name('admindelete');
        Route::get('changeUserRole/{id}', [RoleChangeController::class, 'changeUserRole'])->name('changeUserRole');
        Route::get('userList', [RoleChangeController::class, 'userList'])->name('userList');
        Route::get('deleteUserAccount/{id}', [RoleChangeController::class, 'deleteUserAccount'])->name('userdelete');
        Route::get('changeAdminRole/{id}', [RoleChangeController::class, 'changeAdminRole'])->name('changeAdminRole');
    });

    Route::prefix('order')->group(function () {
        Route::get('list', [OrderBoardController::class, 'list'])->name('orderBoardList');
        Route::get('details/{orderCode}', [OrderBoardController::class, 'userOrderdetails'])->name('userOrderdetails');
        Route::get('change/status', [OrderBoardController::class, 'changeStatus'])->name('changeStatus');
    });

    Route::prefix('salesInfo')->group(function () {
        Route::get('list', [SalesInformationController::class, 'list'])->name('salesInfoList');
    });

    Route::prefix('payment')->group(function () {
        Route::get('create', [PaymentController::class, 'create'])->name('paymentCreate');
        Route::post('create', [PaymentController::class, 'createPayment'])->name('createPayment');
    });

    Route::prefix('reply')->group(function () {
        Route::get('list', [ReplyController::class, 'list'])->name('replyList');
        Route::get('replyMessage/{id}', [ReplyController::class, 'replyMessage'])->name('replyMessage');
        Route::post('replyMessage', [ReplyController::class, 'messageReply'])->name('messageReply');
    });
});


