<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:admin,staff')->group(function () {
        Route::resource('barang', BarangController::class);
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('karyawan', KaryawanController::class);
        Route::resource('users', UserManagementController::class)->except(['show']);
        Route::get('/unduh-laporan-barang', [BarangController::class, 'export'])->name('barang.export');
        Route::get('/barang/export/pdf', [BarangController::class, 'exportPdf'])->name('barang.export.pdf');
        Route::get('/unduh-laporan-karyawan', [KaryawanController::class, 'export'])->name('karyawan.export');
        Route::get('/karyawan/export/pdf', [KaryawanController::class, 'exportPdf'])->name('karyawan.export.pdf');

        Route::get('/activity-log', [\App\Http\Controllers\ActivityLogController::class, 'index'])->name('activity-log.index');
        Route::post('/activity-log/clear', [\App\Http\Controllers\ActivityLogController::class, 'clear'])->name('activity-log.clear');
    });
});

require __DIR__.'/auth.php';
