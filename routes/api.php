<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\settings\SystemSettingsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportDataController;
use App\Http\Controllers\EmailController;


Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('forgotPassword','forgotPassword');
});
// Report

Route::controller(ReportDataController::class)->group(function(){
    Route::get('data-report','show');
    Route::get('data-report2','show2');

});

//Document
Route::controller(ProjectController::class)->group(function(){
    Route::post('addProject','create');
    Route::get('deleteProject/{projectCode}','delete');
    Route::get('getProject','getProject');
    Route::get('getProjectDetail/{id}','getProjectDetail');
});

// Mail=
Route::controller(EmailController::class)->group(function(){
    Route::get('send-welcome-email','index');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('products', ProductController::class);



    // User

    // Setting

    // System Setting
    Route::controller(SystemSettingsController::class)->group(function(){
        Route::post('system-settings','create');
    });


});

