<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;



// Route::middleware('setLanguage')->group(function(){

//     Route::group(["as" => 'user.',"prefix" => '/user', 'middleware' => ['auth', 'userMiddleware']], function () {

//         Route::get('/dashboard', [UserController::class, "index"])->name('dashboard');
//         Route::get('/dashboard/orders', [UserController::class, "dashboard_orders"])->name('dashboard.orders');
//         Route::get('/dashboard/order-view', [UserController::class, "dashboard_orders_views"])->name('dashboard.order.view');
//         Route::get('/dashboard/profile', [UserController::class, "dashboard_profile"])->name('dashboard.profile');
//         Route::get('/dashboard/download', [UserController::class, "dashboard_download"])->name('dashboard.download');
//         Route::get('/dashboard/reviews', [UserController::class, "dashboard_reviews"])->name('dashboard.reviews');
//         Route::get('/dashboard/wishlist', [UserController::class, "dashboard_wishlist"])->name('dashboard.wishlist');
//         Route::get('/dashboard/address', [UserController::class, "dashboard_address"])->name('dashboard.address');
//         Route::get('/dashboard/new-address', [UserController::class, "dashboard_new_address"])->name('dashboard.new.address');
//         Route::get('/dashboard/chat', [UserController::class, "dashboard_chat"])->name('dashboard.chat');
//     });

// });

