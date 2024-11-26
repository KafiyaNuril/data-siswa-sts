<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');

Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/data', [SiswaController::class, 'index'])->name('data');
    Route::get('/tambah', [SiswaController::class, 'create'])->name('tambah');
    Route::post('/tambah', [SiswaController::class, 'store'])->name('tambah.formulir');
    Route::delete('/hapus/{id}', [SiswaController::class, 'destroy'])->name('hapus');
    Route::get('/edit/{id}', [SiswaController::class, 'edit'])->name('edit');
    Route::patch('/edit/{id}', [SiswaController::class, 'update'])->name('edit.formulir');
    Route::get('/export', [SiswaController::class, 'exportExcel'])->name('export');
    Route::get('/export/pdf', [SiswaController::class, 'createPDF'])->name('export.pdf');
});

Route::prefix('/user')->name('user.')->group(function() {
    Route::get('/data', [UserController::class, 'index'])->name('data');
    Route::get('/tambah', [UserController::class, 'create'])->name('tambah');
    Route::post('/tambah', [UserController::class, 'store'])->name('tambah.formulir');
    Route::delete('/hapus/{id}', [UserController::class, 'destroy'])->name('hapus');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::patch('/edit/{id}', [UserController::class, 'update'])->name('edit.formulir');
    Route::get('/export', [UserController::class, 'exportExcel'])->name('export');
});
