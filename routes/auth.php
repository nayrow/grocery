<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\EnsureUserIsLoggedIn;
use App\Http\Middleware\EnsureUserIsNotLoggedIn;
use Illuminate\Support\Facades\Route;

Route::middleware(EnsureUserIsNotLoggedIn::class)->group(function () {
    // Registration Routes
    Route::post('register', [
        RegisterController::class,
        'register'
    ])->name('register');

// Login Routes
    Route::get('login', [
        LoginController::class,
        'showLoginForm'
    ])->name('login');
    Route::post('login', [
        LoginController::class,
        'login'
    ]);

// Google Routes
    Route::get('auth/google', [
        GoogleController::class,
        'redirectToGoogle'
    ])->name('auth.google');
    Route::get('auth/google/callback', [
        GoogleController::class,
        'handleGoogleCallback'
    ]);
});

// Logout Route
Route::middleware(EnsureUserIsLoggedIn::class)->post('logout', [
    LogoutController::class,
    'logout'
])->name('logout');
