<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MinimarketController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenarikanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function(){
    // Dashboard
    Route::get('/', [MinimarketController::class, "index"]);

    // Barang
    Route::resource('/barang', BarangController::class)->except('create', 'show', 'edit');

    // produk
    Route::resource('/produk', ProdukController::class)->except('create', 'show', 'edit');

    // kategori
    Route::resource('/kategori', KategoriController::class)->except('create', 'show', 'edit');

    // pelanggan
    Route::resource('/pelanggan', PelangganController::class)->except('create', 'show', 'edit');

    // Pemasokan
    Route::resource('/pemasokan', PemasokController::class)->except('create', 'show', 'edit');

    // Users
    Route::resource('/users', UserController::class)->except('create', 'show', 'edit');
    
    // Pembelian
    Route::get('/admin/pembelian', [PembelianController::class, "index"]);

    // penarikan
    Route::resource('/penarikan', PenarikanController::class)->except('create', 'show', 'edit');
    Route::get('/penarikan/export/xls', [PenarikanController::class, "excel"]);
    Route::get('/penarikan/export/pdf', [PenarikanController::class, "pdf"]);
});
