<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Pelanggan;
use App\Http\Middleware\RoleBaseRedirect;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->middleware('checkAuth');


Route::controller(AuthController::class)->middleware('checkAuth')->group(function () {
    Route::get('/', 'index');
    Route::post('/login', 'authenticate')->name('loginUser');
    Route::post('/logout', 'logout')->name('logout');
});


Route::resource('user', Pelanggan::class);
