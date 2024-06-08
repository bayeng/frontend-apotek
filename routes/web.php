<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::prefix('supliers')->group(function () {
    Route::get('/', [\App\Http\Controllers\SuplierController::class, 'index']);
    Route::post('/add', [\App\Http\Controllers\SuplierController::class, 'store'])->name('store-suplier');
    Route::delete('/{id}', [\App\Http\Controllers\SuplierController::class, 'destroy'])->name('delete-suplier');
});

Route::prefix('users')->group(function () {
    Route::get('/', [\App\Http\Controllers\UserController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('detail-user');
});


