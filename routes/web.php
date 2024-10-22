<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\Pelanggan;
use App\Http\Controllers\SubCriteriaController;
use App\Http\Controllers\VacancyController;
use App\Http\Middleware\RoleBaseRedirect;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/login', 'authenticate')->name('loginUser');
    Route::post('/logout', 'logout')->name('logout')->middleware('checkAuth');
    Route::get('/admin/login', 'loginAdmin')->name('loginAdminView')->middleware('checkAuth');
    Route::post('/admin/login', 'authenticateAdmin')->name('loginAdmin');
});



Route::controller(AdminController::class)->middleware('checkAuth')->group(function () {
    Route::get('admin/dashboard', 'index')->name('dashboard');
    Route::get('admin/ubah-password', 'ubahPassword')->name('ubah-password-admin');
    Route::post('admin/proses-ubah-password/{user}', 'prosesUbahPassword')->name('proses-password-admin');
});




// Route::resource('criteria', CriteriaController::class)->middleware('checkAuth');
// Route::resource('vacancy', VacancyController::class)->middleware('checkAuth');
Route::prefix('admin')->middleware('checkAuth')->group(function () {
    Route::resource('criteria', CriteriaController::class);
    Route::get('detail-normalisasi/{vacancy}', [CriteriaController::class, 'detailNormalisasi'])->name('detail-normalisasi');
    Route::resource('vacancy', VacancyController::class);
    Route::resource('sub-criteria', SubCriteriaController::class);
});
Route::resource('user', Pelanggan::class);
