<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\UserController;
use App\Models\Admin;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [UserController::class, "register"]);
Route::post('login', [UserController::class, "login"]);

Route::post('admin/register', [AdminController::class, "register"]);
Route::post('admin/login', [AdminController::class, "login"]);

Route::middleware('auth:users')->group(
    function () {
        Route::post('logout', [UserController::class, "logout"]);
        Route::get('user', [UserController::class, "user"]);
        Route::post('refresh', [UserController::class, "refresh"]);
    }
);

Route::middleware('auth:admin')->group(
    function () {
        Route::post('admin/logout', [AdminController::class, "logout"]);
        Route::get('admin/', [AdminController::class, "admin"]);
        Route::post('admin/refresh', [AdminController::class, "refresh"]);




        Route::post('admin/hospitalRegstration', [HospitalController::class, "registerHospital"]);
        Route::get('admin/index', [HospitalController::class, "index"]);
    }

);
