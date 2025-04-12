<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\HeroPageContentController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\Pelanggan;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PortfolioDetailController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubCriteriaController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\WeddingPackageController;
use App\Http\Middleware\RoleBaseRedirect;
use App\Models\Criteria;
use App\Models\Pengumuman;
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
    Route::get('admin/edit-info-akun', 'editInfoAkun')->name('edit-info-akun');
    Route::post('admin/proses-ubah-password/{user}', 'prosesUbahPassword')->name('proses-password-admin');
    Route::post('admin/edit-akun-admin', 'prosesEditAkunAdmin')->name('proses-edit-akun-admin');
    Route::get('admin/kelola-admin', 'kelolaAdmin')->name('kelola-admin');
    Route::post('admin/simpan-admin', 'simpanAdmin')->name('simpan-admin');
    Route::post('admin/hapus-admin/{admin}', 'hapusAdmin')->name('hapus-admin');
    Route::get('admin/edit-admin/{admin}', 'editAdmin')->name('edit-admin');
    Route::post('admin/proses-edit-admin/{admin}', 'prosesEditAdmin')->name('proses-edit-admin');


    Route::get('admin/kelola-pengguna', 'kelolaPengguna')->name('kelola-pengguna');
    Route::get('admin/ubah-password-pengguna/{user}', 'ubahPasswordPengguna')->name('ubah-password-pengguna');
    Route::post('admin/proses-ubah-password-pengguna/{user}', 'prosesUbahPasswordPengguna')->name('proses-ubah-password-pengguna');
    Route::post('admin/hapus-pengguna/{user}', 'hapusPengguna')->name('hapus-pengguna');
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

    Route::resource('pelamar', PelamarController::class);
    Route::controller(PelamarController::class)->group(function () {
        Route::get('data-lamaran/{vacancy}/periode', 'dataPeriodeLowonganLamaran')->name('data-lamaran.vacancy.periode');
        Route::get('data-lamaran/{vacancy}/periode/{periode}/pelamar', 'dataLamaran')->name('data-lamaran.vacancy.periode.pelamar');
        // Route::get('data-lamaran/{vacancy}', 'dataLamaran')->name('data-lamaran');


        Route::delete('data-lamaran/{application}', 'hapusPelamar')->name('hapus-pelamar');
        Route::get('data-lamaran/{periode}/detail-pelamar/{application}/seleksi', 'seleksiPelamar')->name('seleksi-pelamar');
        Route::post('data-lamaran/{periode}/detail-pelamar/{application}/seleksi', 'simpanDataAlternatif')->name('simpan-data-alternatif');

        Route::get('penilaian', 'penilaian')->name('penilaian');
        // Route::get('hitung-saw/{vacancy}', 'calculateSAW')->name('calculate-saw');
        Route::get('hitung-saw/{vacancy}/periode', 'hitungSawPeriode')->name('hitung-saw.vacancy.periode');
        Route::get('hitung-saw/{vacancy}/periode/{periode}/penilaian', 'calculateSaw')->name('calculate-saw');
        Route::post('simpan-saw', 'simpanSAW')->name('simpan-saw');
    });

    Route::resource('pengumuman', PengumumanController::class);
});


Route::resource('user', Pelanggan::class);
Route::controller(Pelanggan::class)->group(function () {
    Route::get('portfolio', 'portfolio')->name('portfolio-user');
    Route::get('about-us', 'aboutUs')->name('about-us');
    Route::get('portfolio-detail/{portfolio}', 'portfolioDetail')->name('portfolio-detail');
    Route::get('our-services', 'ourServices')->name('our-services');
    Route::get('lowongan', 'lowongan')->name('lowongan');
    Route::get('daftar-lamaran/{vacancy}', 'daftarLamaran')->middleware('checkAuth')->name('daftar-lamaran');
    Route::post('daftar-lamaran/{periode}', 'simpanLamaran')->middleware('checkAuth')->name('simpan-lamaran');
    Route::get('data-diri', 'dataDiri')->middleware('checkAuth')->name('data-diri');
    Route::post('data-diri', 'simpanDataDiri')->middleware('checkAuth')->name('simpan-data-diri');


    Route::get('pengumuman', 'pengumuman')->middleware('checkAuth')->name('pengumuman');
    Route::get('detail-pengumuman/{application}', 'detailPengumuman')->middleware('checkAuth')->name('detail-pengumuman');
});


Route::controller(PeriodeController::class)->group(function () {
    Route::delete('hapus-periode/{periode}', 'hapusPeriode')->name('hapus-periode');
    Route::post('tambah-periode', 'tambahPeriode')->name('tambah-periode');
    Route::get('edit-periode/{periode}', 'editPeriode')->name('edit-periode');
    Route::put('proses-edit/{periode}', 'prosesEdit')->name('proses-edit');
    Route::get('detail-periode/vacancy/{vacancy}/periode/{periode}', 'detailPeriode')->name('detail-periode');
})->middleware('checkAuth');



Route::controller(CriteriaController::class)->group(function () {
    Route::post('copy-criteria', 'copyCriteria')->name('copy-criteria');
});
