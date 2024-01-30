<?php

use App\Http\Controllers\MasterBarangController;
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

});

