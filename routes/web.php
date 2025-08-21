<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('tentangBebras')->name('tentangBebras.')->group(function () {
    Route::view('/dd_1', 'pages.tentangBebras.dd_1')->name('dd_1');
    Route::view('/dd_2', 'pages.tentangBebras.dd_2')->name('dd_2');
    Route::view('/dd_3', 'pages.tentangBebras.dd_3')->name('dd_3');
    Route::view('/dd_4', 'pages.tentangBebras.dd_4')->name('dd_4');
    Route::view('/dd_5', 'pages.tentangBebras.dd_5')->name('dd_5');
       Route::view('/dd_6', 'pages.tentangBebras.dd_6')->name('dd_6');
});
