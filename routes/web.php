<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/supliers', [\App\Http\Controllers\SuplierController::class, 'index']);
Route::get('/supliers/add', [\App\Http\Controllers\SuplierController::class, 'addPage'])->name('add-suplier');
Route::post('/supliers/add', [\App\Http\Controllers\SuplierController::class, 'store'])->name('store-suplier');
Route::delete('/supliers/{id}', [\App\Http\Controllers\SuplierController::class, 'destroy'])->name('delete-suplier');
