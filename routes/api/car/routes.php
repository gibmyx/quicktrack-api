<?php

use Illuminate\Support\Facades\Route;

Route::middleware('jwt')
    ->group(function () {
        Route::post('/car', Quicktrack\Car\Infrastructure\Controllers\Api\CarPostController::class);
        Route::get('/car/{id}', Quicktrack\Car\Infrastructure\Controllers\Api\CarGetController::class);
        Route::put('/car/{id}', Quicktrack\Car\Infrastructure\Controllers\Api\CarPutController::class); 
        Route::get('/cars', Quicktrack\Car\Infrastructure\Controllers\Api\CarsGetController::class);
        Route::get('/car-code', Quicktrack\Car\Infrastructure\Controllers\Api\CarNextCodeGetController::class);
    });