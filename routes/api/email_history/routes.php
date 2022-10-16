<?php

use Illuminate\Support\Facades\Route;

Route::post('/email-history', \Quicktrack\EmailHistory\Infrastructure\Controllers\EmailHistoryPostController::class);
