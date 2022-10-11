<?php

use Illuminate\Support\Facades\Route;

Route::post('/car', Quicktrack\Car\Infrastructure\Controllers\Api\CarPostController::class);

/* Route::middleware('auth:api')
    ->group(function () {
        Route::post('/car', Quicktrack\Car\Infrastructure\Controllers\Api\CarPostController::class);
    }); */