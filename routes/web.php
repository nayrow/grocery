<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ItemController;
use App\Http\Middleware\EnsureUserIsLoggedIn;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::group(['middleware' => EnsureUserIsLoggedIn::class], function () {
    Route::get('/list', function () {
        return view('list');
    })->name('list');

    Route::get('/stock', function () {
        return view('stock');
    })->name('stock');

    Route::resource('items', ItemController::class)->except('update');

    Route::put('items/updateCheckedItems', [ItemController::class, 'updateCheckedItems'])->name('items.updateCheckedItems');
    Route::put('items/{item}/updateQuantity', [ItemController::class, 'updateQuantity'])->name('items.updateQuantity');
});

