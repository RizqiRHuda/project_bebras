<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WorkshopController;

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/search/suggest', [SearchController::class, 'suggest'])->name('search.suggest');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('tentangBebras')->name('tentangBebras.')->group(function () {
    Route::view('/dd_1', 'pages.tentangBebras.dd_1')->name('dd_1');
    Route::view('/dd_2', 'pages.tentangBebras.dd_2')->name('dd_2');
    Route::view('/dd_3', 'pages.tentangBebras.dd_3')->name('dd_3');
    Route::view('/dd_4', 'pages.tentangBebras.dd_4')->name('dd_4');
    Route::view('/dd_5', 'pages.tentangBebras.dd_5')->name('dd_5');
    Route::view('/dd_6', 'pages.tentangBebras.dd_6')->name('dd_6');
});

Route::prefix('soal')->name('soal.')->group(function () {
    Route::view('/index-soal', 'pages.soal.index_soal')->name('index-soal');
    Route::view('/pembahasan-soal', 'pages.soal.pembahasan_soal')->name('pembahasan-soal');
    Route::view('/siaga-sd', 'pages.soal.sd')->name('siaga-sd');
    Route::view('/penggalang-smp', 'pages.soal.smp')->name('penggalang-smp');
    Route::view('/penegak-sma', 'pages.soal.sma')->name('penegak-sma');
});

Route::prefix('kegiatan')->name('kegiatan.')->group(function () {

    // Route::get('/{slug}', [WorkshopController::class, 'byTahun'])->name('workshop.tahun');
    Route::get('workshop-{slug}', [WorkshopController::class, 'byTahun'])->name('workshop.tahun');

    Route::get('/pengumuman-hasil', [App\Http\Controllers\PengumumanController::class, 'index'])->name('pengumuman-hasil');
    Route::get('/pengumuman-hasil/{id}', [App\Http\Controllers\PengumumanController::class, 'show'])->name('pengumuman-hasil.show');
    Route::get('/pengumuman-hasil/{id}/file', [App\Http\Controllers\PengumumanController::class, 'proxyFile'])->name('pengumuman-hasil.file');
    Route::get('/pengumuman-hasil/{id}/preview', [App\Http\Controllers\PengumumanController::class, 'preview'])->name('pengumuman-hasil.preview');
});

Route::get('/latihan', function () {
    return view('pages.latihan.index');
})->name('latihan');

Route::get('/kontak', function () {
    return view('pages.kontak.index');
})->name('kontak');

Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/{slug}', [HomeController::class, 'tampilBerita'])->name('detail');
});

Route::get('/info-lengkap', [HomeController::class, 'infoLengkap'])->name('info-lengkap');