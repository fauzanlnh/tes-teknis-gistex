<?php

use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\MasterPembelianBarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterUserController;

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

Route::get('/', [AuthController::class, 'viewLoginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.index');

    Route::resource('dashboard/user', MasterUserController::class)->names('dashboard.user');

    Route::get('/dashboard/barang', [MasterBarangController::class, 'index'])->name('dashboard.barang.index');
    Route::get('/dashboard/barang/create', [MasterBarangController::class, 'create'])->name('dashboard.barang.create');
    Route::post('/dashboard/barang/', [MasterBarangController::class, 'store'])->name('dashboard.barang.store');
    Route::get('/dashboard/barang/{kode_barang}/edit', [MasterBarangController::class, 'edit'])->name('dashboard.barang.edit');
    Route::patch('/dashboard/barang/{kode_barang}/', [MasterBarangController::class, 'update'])->name('dashboard.barang.update');
    Route::delete('/dashboard/barang/{kode_barang}', [MasterBarangController::class, 'destroy'])->name('dashboard.barang.destroy');



    Route::get('/dashboard/pembelian-barang', [MasterPembelianBarangController::class, 'index'])->name('dashboard.pembelian-barang.index');
    Route::get('/dashboard/pembelian-barang/create', [MasterPembelianBarangController::class, 'create'])->name('dashboard.pembelian-barang.create');
    Route::post('/dashboard/pembelian-barang/', [MasterPembelianBarangController::class, 'store'])->name('dashboard.pembelian-barang.store');
    Route::get('/dashboard/pembelian-barang/{no_pembelian}/edit', [MasterPembelianBarangController::class, 'edit'])->name('dashboard.pembelian-barang.edit');
    Route::patch('/dashboard/pembelian-barang/{no_pembelian}/', [MasterPembelianBarangController::class, 'update'])->name('dashboard.pembelian-barang.update');
    Route::delete('/dashboard/pembelian-barang/{no_pembelian}', [MasterPembelianBarangController::class, 'destroy'])->name('dashboard.pembelian-barang.destroy');

});

