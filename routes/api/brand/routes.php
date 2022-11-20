<?php

use Illuminate\Support\Facades\Route;

Route::middleware('jwt')
    ->group(function () {
        Route::post('/brand', \Quicktrack\Brand\Infrastructure\Controllers\Api\BrandPostController::class);
        Route::put('/brand/{id}', \Quicktrack\Brand\Infrastructure\Controllers\Api\BrandPutController::class);
        Route::get('/brand/{id}', \Quicktrack\Brand\Infrastructure\Controllers\Api\BrandGetController::class);
        Route::get('/brands', \Quicktrack\Brand\Infrastructure\Controllers\Api\BrandsGetController::class);
    });
