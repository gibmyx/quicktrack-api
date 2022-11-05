<?php

use Illuminate\Support\Facades\Route;

Route::middleware('jwt')
    ->group(function () {
        Route::post('/email-notification', \Quicktrack\EmailNotification\Infrastructure\Controllers\Api\EmailNotificationPostController::class);
        Route::put('/email-notification/{id}', \Quicktrack\EmailNotification\Infrastructure\Controllers\Api\EmailNotificationPutController::class);
        Route::delete('/email-notification/{id}', \Quicktrack\EmailNotification\Infrastructure\Controllers\Api\EmailNotificationDeleteController::class);
        Route::get('/emails-notification', \Quicktrack\EmailNotification\Infrastructure\Controllers\Api\EmailsNotificationGetController::class);
    });
