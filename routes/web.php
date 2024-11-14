<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\HeroPageContentController;
use App\Http\Controllers\Pelanggan;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PortfolioDetailController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubCriteriaController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\WeddingPackageController;
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
    Route::resource('criteria.sub-criteria', SubCriteriaController::class);
    Route::get('all-criteria-subcriteria', action: [SubCriteriaController::class, 'showAll'])->name('criteria-subcriteria.index');
    Route::resource('hero-content', HeroPageContentController::class);
    Route::resource('portfolio', PortfolioController::class);
    Route::resource('portfolio.portfolio-detail', PortfolioDetailController::class);
    Route::resource('about-us', AboutUsController::class);
    Route::resource('testimonial', TestimonialController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('wedding-package', WeddingPackageController::class);
});

Route::resource('user', Pelanggan::class);
Route::controller(Pelanggan::class)->group(function () {
    Route::get('portfolio', 'portfolio')->name('portfolio-user');
    Route::get('about-us', 'aboutUs')->name('about-us');
    Route::get('portfolio-detail/{portfolio}', 'portfolioDetail')->name('portfolio-detail');
    Route::get('our-services', 'ourServices')->name('our-services');
});
