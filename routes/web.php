<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [UserController::class, 'login'])->name('login');

Route::prefix('supliers')->group(function () {
    Route::get('/', [\App\Http\Controllers\SuplierController::class, 'index'])->name('supliers');
    Route::get('/{id}', [\App\Http\Controllers\SuplierController::class, 'show'])->name('detail-suplier');
    Route::post('/add', [\App\Http\Controllers\SuplierController::class, 'store'])->name('store-suplier');
    Route::delete('/{id}', [\App\Http\Controllers\SuplierController::class, 'destroy'])->name('delete-suplier');
    Route::patch('/{id}', [\App\Http\Controllers\SuplierController::class, 'update'])->name('edit-suplier');
});

Route::prefix('users')->group(function () {
    Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('detail-user');
    Route::post('/', [\App\Http\Controllers\UserController::class, 'store'])->name('store-user');
    Route::patch('/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('edit-user');
    Route::delete('/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('delete-user');

});

Route::prefix('obatmasuks')->group(function (){
    Route::get('/', [\App\Http\Controllers\ObatMasukController::class, 'index'])->name('obatmasuk');
    Route::get('/{id}', [\App\Http\Controllers\ObatMasukController::class, 'show'])->name('detail-obatmasuk');
    Route::post('/', [\App\Http\Controllers\ObatMasukController::class, 'store'])->name('store-obatmasuk');
    Route::get('/add', [\App\Http\Controllers\ObatMasukController::class, 'storePage'])->name('storepage-obatmasuk');
});

Route::resource('/obats', ObatController::class)->names('obat');

Route::prefix('apotek')->group(function () {
    Route::get('/', [ResepController::class, 'create'])->name('apotek.create');
    Route::get('/riwayat', [ResepController::class, 'index'])->name('apotek.index');
    Route::post('/store', [ResepController::class, 'store'])->name('apotek.store');
    Route::get('/generatepdf', [ResepController::class, 'generatePDF'])->name('generate-pdf');
});

Route::prefix('tujuans')->group(function (){
    Route::get('/', [\App\Http\Controllers\TujuanController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\TujuanController::class, 'store'])->name('store-tujuan');
    Route::delete('/{id}', [\App\Http\Controllers\TujuanController::class, 'destroy'])->name('delete-tujuan');
});

