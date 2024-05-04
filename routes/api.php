<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\settings\SystemSettingsController;

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('products', ProductController::class);

    //Document

    // User

    // Setting

    // System Setting
    Route::controller(SystemSettingsController::class)->group(function(){
        Route::post('system-settings','create');
    });
});

