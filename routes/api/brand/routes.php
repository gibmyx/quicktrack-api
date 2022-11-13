<?php

use Illuminate\Support\Facades\Route;

Route::middleware('jwt')
    ->group(function () {
        Route::get('/brands', \Quicktrack\Brand\Infrastructure\Controllers\Api\BrandsGetController::class);
    });
