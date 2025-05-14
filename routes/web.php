<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\infoCustomerController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\laporanPelangganController;
use App\Http\Controllers\laporanTransaksiController;
use App\Http\Controllers\levelController;
use App\Http\Controllers\pelangganController;
use App\Http\Controllers\penggunaanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\tagihanController;
use App\Http\Controllers\tagihanCustomerController;
use App\Http\Controllers\tarifController;
use App\Http\Middleware\admin;
use App\Http\Middleware\pelanggan;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => pelanggan::class], function () {
	Route::get('dashboard-pelanggan', [HomeController::class, 'indexPelanggan'])->name('dashboard.pelanggan');
	Route::get('/', [HomeController::class, 'home']);
	Route::get('/logoutAuth', [AuthController::class, 'destroy']);

	Route::get('/profile', [infoCustomerController::class, 'create']);
	Route::post('/profile', [infoCustomerController::class, 'store']);

	Route::get('tagihan', [tagihanCustomerController::class, 'show'])->name('tagihan.index');
	Route::post('tagihan/bayar', [tagihanCustomerController::class, 'store'])->name('invoiceCustomer.index');
	Route::get('tagihan/invoice/{id}', [tagihanCustomerController::class, 'generateInvoice'])->name('invoiceCustomer.generate');
});
Route::group(['middleware' => admin::class], function () {
	Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

	// Pengaturan Pengguna
	Route::group(['middleware' => ['check.admin.level:administrator']], function () {
		Route::get('pengaturan-pengguna', [adminController::class, 'index'])->name('user-management.index');
		Route::post('pengaturan-pengguna/tambah', [adminController::class, 'store'])->name('pengaturan-pengguna-tambah');
		Route::get('pengaturan-pengguna/put/{id}', [adminController::class, 'put'])->name('user-management.put');
		Route::post('pengaturan-pengguna/update', [adminController::class, 'update']);
		Route::get('pengaturan-pengguna/delete/{id}', [adminController::class, 'destroy'])->name('user-management.destroy');


		// Pengaturan Level
		Route::get('pengaturan-level', [levelController::class, 'index'])->name('level-management.index');
		Route::post('pengaturan-level/tambah', [levelController::class, 'store'])->name('pengaturan-level-tambah');
		Route::get('pengaturan-level/put/{id}', [levelController::class, 'put'])->name('level-management.put');
		Route::post('pengaturan-level/update', [levelController::class, 'update']);
		Route::get('pengaturan-level/delete/{id}', [levelController::class, 'destroy'])->name('level-management.destroy');
	});


	Route::group(['middleware' => ['check.admin.level:administrator']], function () {
		// Pengaturan Tarif
		Route::get('pengaturan-tarif', [tarifController::class, 'index'])->name('tarif-management.index');
		Route::post('pengaturan-tarif/tambah', [tarifController::class, 'store'])->name('pengaturan-tarif-tambah');
		Route::get('pengaturan-tarif/put/{id}', [tarifController::class, 'put'])->name('tarif-management.put');
		Route::post('pengaturan-tarif/update', [tarifController::class, 'update']);
		Route::get('pengaturan-tarif/delete/{id}', [tarifController::class, 'destroy'])->name('tarif-management.destroy');



		// Pengaturan Pelanggan
		Route::get('pengaturan-pelanggan', [pelangganController::class, 'index'])->name('pelanggan-management.index');
		Route::post('pengaturan-pelanggan/tambah', [pelangganController::class, 'store'])->name('pengaturan-pelanggan-tambah');
		Route::get('pengaturan-pelanggan/put/{id}', [pelangganController::class, 'put'])->name('pelanggan-management.put');
		Route::post('pengaturan-pelanggan/update', [pelangganController::class, 'update']);
		Route::get('pengaturan-pelanggan/delete/{id}', [pelangganController::class, 'destroy'])->name('pelanggan-management.destroy');

		// Pengaturan Penggunaan
		Route::get('penggunaan-listrik', [penggunaanController::class, 'index'])->name('penggunaan-management.index');
		Route::post('detail-penggunaan-listrik/tambah', [penggunaanController::class, 'store'])->name('pengaturan-penggunaan-tambah');
		Route::get('detail-penggunaan-listrik/put/{id}', [penggunaanController::class, 'put'])->name('penggunaan-management.put');
		Route::get('detail-penggunaan-listrik/{id}', [penggunaanController::class, 'show'])->name('detail-penggunaan-management.index');
	});
	Route::post('detail-penggunaan-listrik/update', [penggunaanController::class, 'update']);


	// Pengaturan Tagihan
	Route::get('tagihan-listrik', [tagihanController::class, 'index'])->name('tagihan-management.index');
	Route::get('detail-tagihan-listrik/{id}', [tagihanController::class, 'show'])->name('detail-tagihan-management.index');
	Route::post('detail-tagihan-listrik/bayar', [tagihanController::class, 'store'])->name('invoice.index');
	Route::get('detail-tagihan-listrik/invoice/{id}', [tagihanController::class, 'generateInvoice'])->name('invoice.generate');

	Route::group(['middleware' => ['check.admin.level:pimpinan']], function () {
		Route::get('laporan-pelanggan', [laporanPelangganController::class, 'index'])->name('laporan-pelanggan.index');
		Route::get('laporan-pelanggan/export', [laporanPelangganController::class, 'export']);


		Route::get('laporan-transaksi', [laporanTransaksiController::class, 'index'])->name('laporan-transaksi.index');
		Route::get('laporan-transaksi/export', [laporanTransaksiController::class, 'export']);
	});

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);

	Route::get('/login-admin', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store'])->name('register');
	Route::get('/login-admin', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);

	Route::get('/login', [AuthController::class, 'create']);
	Route::post('/auth', [AuthController::class, 'store']);
});

Route::get('/login', function () {
	return view('authGuest/login-session');
})->name('loginPelanggan');
Route::get('/login-admin', function () {
	return view('session/login-session');
})->name('login');
