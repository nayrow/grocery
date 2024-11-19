<?php

use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\ItemController;
use App\Http\Middleware\EnsureUserIsLoggedIn;
use Illuminate\Support\Facades\Auth;
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

    Route::get('/profile', function () {
        $user = Auth::user();
        return view('profile',compact('user'));
    })->name('profile');

    Route::resource('items', ItemController::class)->except('update');

    Route::put('items/updateCheckedItems', [ItemController::class, 'updateCheckedItems'])->name('items.updateCheckedItems');
    Route::put('items/{item}/updateQuantity', [ItemController::class, 'updateQuantity'])->name('items.updateQuantity');

    Route::resource('households', HouseholdController::class)->except('index');
    Route::post('households/{household}/invite/{user}', [HouseholdController::class, 'invite'])->name('households.invite');
    Route::put('households/{household}/accept-invitation/{user}', [HouseholdController::class, 'acceptInvitation'])->name('households.accept-invitation');
    Route::put('households/{household}/reject-invitation/{user}', [HouseholdController::class, 'rejectInvitation'])->name('households.reject-invitation');
});

