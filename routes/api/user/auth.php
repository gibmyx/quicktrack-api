<?php

use Illuminate\Support\Facades\Route;

Route::post('/auth/login', \Quicktrack\User\Infrastructure\Controllers\Api\LoginController::class)->name("login");
Route::post('/auth/forgot-password', \Quicktrack\User\Infrastructure\Controllers\Api\ForgotPasswordController::class);
Route::post('/auth/reset-password', \Quicktrack\User\Infrastructure\Controllers\Api\NewPasswordController::class);

Route::middleware('auth:api')
    ->group(function () {
        Route::post('/auth/logout', \Quicktrack\User\Infrastructure\Controllers\Api\LogoutController::class);
        Route::get('/auth/verify-token', \Quicktrack\User\Infrastructure\Controllers\Api\VerifyTokenController::class);
    });
