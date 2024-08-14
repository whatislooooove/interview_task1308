<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::post('/info', [App\Http\Controllers\YandexApiController::class, 'getAddressInfo'])->name('info');

