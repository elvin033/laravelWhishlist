<?php

use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::prefix('wishlist')->controller(WishlistController::class)->group(function () {
    Route::get('/', 'getAllProducts')->name('wishlist.index');
    Route::get('/get/{id}', 'get');
    Route::get('/add', 'add');
    Route::get('/delete/{id}', 'delete');
    Route::get('/clear', 'clear');
});
