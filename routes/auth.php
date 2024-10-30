<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

// Registration Routes
Route::post('register', [
    RegisterController::class,
    'register'
])->name('register');

// Login Routes
Route::post('login', [
    LoginController::class,
    'login'
])->name('login');

// Logout Route
Route::post('logout', [
    LogoutController::class,
    'logout'
])->name('logout');

// Google Routes
Route::get('auth/google', [
    GoogleController::class,
    'redirectToGoogle'
])->name('auth.google');
Route::get('auth/google/callback', [
    GoogleController::class,
    'handleGoogleCallback'
]);
