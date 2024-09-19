<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Pelanggan;
use App\Http\Middleware\RoleBaseRedirect;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/login', 'authenticate')->name('loginUser');
    Route::post('/logout', 'logout')->name('logout')->middleware('checkAuth');
});



Route::resource('user', Pelanggan::class);
