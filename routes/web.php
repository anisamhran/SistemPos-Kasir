<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// Route::group(['middleware' => 'role:1'], function () {
    Route::group(['middleware' => 'auth'], function () {
   
//SATUAN
Route::get('/data-satuan', [\App\Http\Controllers\SatuanController::class, 'index'])->name('data-satuan');
Route::get('/create-satuan', [\App\Http\Controllers\SatuanController::class, 'create'])->name('create-satuan');
Route::post('/create-satuan', [\App\Http\Controllers\SatuanController::class, 'store'])->name('save-satuan');
Route::get('/edit-satuan/{id}', [\App\Http\Controllers\SatuanController::class, 'edit'])->name('edit-satuan');
Route::put('/edit-satuan/{id}', [\App\Http\Controllers\SatuanController::class, 'update'])->name('update-satuan');
Route::delete('/hapus-satuan/{id}', [\App\Http\Controllers\SatuanController::class, 'destroy'])->name('destroy-satuan');
Route::get('/data-satuan-dihapus', [\App\Http\Controllers\SatuanController::class, 'deleted'])->name('data-satuan-dihapus');
Route::get('/restore-satuan-dihapus{id}', [\App\Http\Controllers\SatuanController::class, 'restore'])->name('restore-satuan-dihapus');


//JENIS BARANG
Route::get('/data-jenis-barang', [\App\Http\Controllers\JenisBarangController::class, 'index'])->name('data-jenis-barang');
Route::get('/create-jenis-barang', [\App\Http\Controllers\JenisBarangController::class, 'create'])->name('create-jenis-barang');
Route::post('/create-jenis-barang', [\App\Http\Controllers\JenisBarangController::class, 'store'])->name('save-jenis-barang');
Route::get('/edit-jenis-barang/{id}', [\App\Http\Controllers\JenisBarangController::class, 'edit'])->name('edit-jenis-barang');
Route::put('/edit-jenis-barang/{id}', [\App\Http\Controllers\JenisBarangController::class, 'update'])->name('update-jenis-barang');
Route::delete('/hapus-jenis-barang/{id}', [\App\Http\Controllers\JenisBarangController::class, 'destroy'])->name('destroy-jenis-barang');
Route::get('/data-jenis-barang-dihapus', [\App\Http\Controllers\JenisBarangController::class, 'deleted'])->name('data-jenis-barang-dihapus');
Route::get('/restore-jenis-barang-dihapus{id}', [\App\Http\Controllers\JenisBarangController::class, 'restore'])->name('restore-jenis-barang-dihapus');


//BARANG
Route::get('/barang', [\App\Http\Controllers\BarangController::class, 'index'])->name('data-barang');
Route::get('/create-barang', [\App\Http\Controllers\BarangController::class, 'create'])->name('create-barang');
Route::post('/create-barang', [\App\Http\Controllers\BarangController::class, 'store'])->name('save-barang');
Route::get('/edit-barang/{id}', [\App\Http\Controllers\BarangController::class, 'edit'])->name('edit-barang');
Route::put('/edit-barang/{id}', [\App\Http\Controllers\BarangController::class, 'update'])->name('update-barang');
Route::delete('/hapus-barang/{id}', [\App\Http\Controllers\BarangController::class, 'destroy'])->name('destroy-barang');
Route::get('/data-barang-dihapus', [\App\Http\Controllers\BarangController::class, 'deleted'])->name('data-barang-dihapus');
Route::get('/restore-barang-dihapus{id}', [\App\Http\Controllers\BarangController::class, 'restore'])->name('restore-barang-dihapus');


//VENDOR
Route::get('/data-vendor', [\App\Http\Controllers\VendorController::class, 'index'])->name('data-vendor');
Route::get('/create-vendor', [\App\Http\Controllers\VendorController::class, 'create'])->name('create-vendor');
Route::post('/create-vendor', [\App\Http\Controllers\VendorController::class, 'store'])->name('save-vendor');
Route::get('/edit-vendor/{id}', [\App\Http\Controllers\VendorController::class, 'edit'])->name('edit-vendor');
Route::put('/edit-vendor/{id}', [\App\Http\Controllers\VendorController::class, 'update'])->name('update-vendor');
Route::delete('/hapus-vendor/{id}', [\App\Http\Controllers\VendorController::class, 'destroy'])->name('destroy-vendor');
Route::get('/data-vendor-dihapus', [\App\Http\Controllers\VendorController::class, 'deleted'])->name('data-vendor-dihapus');
Route::get('/restore-vendor-dihapus{id}', [\App\Http\Controllers\VendorController::class, 'restore'])->name('restore-vendor-dihapus');


//BADAN HUKUM VENDOR
Route::get('/data-badan-hukum', [\App\Http\Controllers\BadanHukumController::class, 'index'])->name('data-badan-hukum');
Route::get('/create-badan-hukum', [\App\Http\Controllers\BadanHukumController::class, 'create'])->name('create-badan-hukum');
Route::post('/create-badan-hukum', [\App\Http\Controllers\BadanHukumController::class, 'store'])->name('save-badan-hukum');
Route::get('/edit-badan-hukum/{id}', [\App\Http\Controllers\BadanHukumController::class, 'edit'])->name('edit-badan-hukum');
Route::put('/edit-badan-hukum/{id}', [\App\Http\Controllers\BadanHukumController::class, 'update'])->name('update-badan-hukum');
Route::delete('/hapus-badan-hukum/{id}', [\App\Http\Controllers\BadanHukumController::class, 'destroy'])->name('destroy-badan-hukum');
Route::get('/data-badan-hukum-dihapus', [\App\Http\Controllers\BadanHukumController::class, 'deleted'])->name('data-badan-hukum-dihapus');
Route::get('/restore-badan-hukum-dihapus{id}', [\App\Http\Controllers\BadanHukumController::class, 'restore'])->name('restore-badan-hukum-dihapus');


//USER
Route::get('/data-user', [\App\Http\Controllers\UserController::class, 'index'])->name('data-user');
Route::get('/create-user', [\App\Http\Controllers\UserController::class, 'create'])->name('create-user');
Route::post('/create-user', [\App\Http\Controllers\UserController::class, 'store'])->name('save-user');
Route::get('/edit-user/{id}', [\App\Http\Controllers\UserController::class, 'edit'])->name('edit-user');
Route::put('/edit-user/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('update-user');
Route::delete('/hapus-user/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('destroy-user');
Route::get('/data-user-dihapus', [\App\Http\Controllers\UserController::class, 'deleted'])->name('data-user-dihapus');
Route::get('/restore-user-dihapus{id}', [\App\Http\Controllers\UserController::class, 'restore'])->name('restore-user-dihapus');


//PENGADAAN
Route::get('/data-pengadaan', [\App\Http\Controllers\PengadaanController::class, 'index'])->name('data-pengadaan');
Route::get('/create-pengadaan', [\App\Http\Controllers\PengadaanController::class, 'create'])->name('create-pengadaan');
Route::post('/create-pengadaan', [\App\Http\Controllers\PengadaanController::class, 'tambahPengadaan'])->name('save-pengadaan');
Route::get('/detail-pengadaan/{id}', [\App\Http\Controllers\PengadaanController::class, 'detail'])->name('detail-pengadaan');


//PENERIMAAN
Route::get('/data-penerimaan', [\App\Http\Controllers\PenerimaanController::class, 'dataPenerimaan'])->name('data-penerimaan');
Route::get('/create-penerimaan', [\App\Http\Controllers\PenerimaanController::class, 'create'])->name('create-penerimaan');
Route::get('/detail-penerimaan/{id}', [\App\Http\Controllers\PenerimaanController::class, 'detail'])->name('detail-penerimaan');
Route::post('/terima-pengadaan', [\App\Http\Controllers\PenerimaanController::class, 'terimaPengadaan'])->name('terima-pengadaan');
// Route::get('/data-penerimaan', [\App\Http\Controllers\PenerimaanController::class, 'dataPenerimaan'])->name('data-penerimaan');


//RETUR
Route::get('/data-retur', [\App\Http\Controllers\ReturController::class, 'index'])->name('data-retur');
Route::get('/create-retur', [\App\Http\Controllers\ReturController::class, 'create'])->name('create-retur');
Route::post('/retur', [\App\Http\Controllers\ReturController::class, 'addretur'])->name('retur');
Route::get('/detail-retur/{id}', [\App\Http\Controllers\ReturController::class, 'detail'])->name('detail-retur');
// Route::get('/logout', [\App\Http\Controllers\PengadaanController::class, 'logout'])->name('logout');


//PENJUALAN
Route::get('/data-penjualan', [\App\Http\Controllers\PenjualanController::class, 'index'])->name('data-penjualan');
Route::post('/create-penjualan', [\App\Http\Controllers\PenjualanController::class, 'create'])->name('create-penjualan');
// Route::get('/logout', [\App\Http\Controllers\PengadaanController::class, 'logout'])->name('logout');



Route::get('/stok-barang', [\App\Http\Controllers\StokController::class, 'index'])->name('data-stok');

});
// });

//AUTHENTICATION
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login-proses', [\App\Http\Controllers\AuthController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');



// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

