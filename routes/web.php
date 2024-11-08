<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('items', ItemController::class)->except('destroy');

    Route::delete('items/destroy', [ItemController::class, 'destroy'])->name('items.destroy');
});

