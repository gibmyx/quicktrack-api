<?php

use Illuminate\Support\Facades\Route;

Route::middleware('jwt')
    ->group(function () {
        Route::post('/email-notification', \Quicktrack\EmailNotification\Infrastructure\Controllers\EmailNotificationPostController::class);
        Route::post('/email-notification', \Quicktrack\EmailNotification\Infrastructure\Controllers\EmailNotificationPostController::class);
    });
