<?php

use Illuminate\Support\Facades\Route;

Route::post('/email-history', \Quicktrack\EmailHistory\Infrastructure\Controllers\EmailHistoryPostController::class);
Route::middleware('jwt')
    ->group(function () {
        Route::get('/email-history/{id}', \Quicktrack\EmailHistory\Infrastructure\Controllers\EmailHistoryGetController::class);
    });
