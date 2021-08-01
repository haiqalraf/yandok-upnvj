<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuketController;
use App\Http\Controllers\LainyaController;
use App\Http\Controllers\LegalisirController;
use App\Http\Controllers\admin\PesananController;
use App\Http\Controllers\superadmin\AkpkController;
use App\Http\Controllers\superadmin\DekanController;

/*
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
})->name('index');

Auth::routes();

Route::get('/alur', [App\Http\Controllers\HomeController::class, 'alur'])->name('alur');
Route::resource('legalisir',LegalisirController::class)->middleware('auth');
Route::post('/actionUpdUser', [App\Http\Controllers\ActionController::class, 'updateUser'])->name('updUser');
Route::resource('surat', SuketController::class)->middleware('auth');
Route::get('lainnya',[LainyaController::class,'index'])->name('lainnya')->middleware('auth');
Route::post('lainnya',[LainyaController::class,'bulkUpdate'])->middleware('auth');
Route::get('formpengajuan',[LainyaController::class,'create'])->name('lainnya.pengajuan')->middleware('auth');
Route::post('formpengajuan',[LainyaController::class,'store'])->middleware('auth');

Route::post('apiupn',[ApiController::class,'apiUpn'])->name('apiupn');
Route::post('storeData',[ApiController::class,'storeData'])->name('storeData');
Route::post('verifikasi',[ApiController::class,'verifikasi'])->name('verifikasi');
#
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
#

#akpk
Route::get('akpk/home', [HomeController::class, 'adminHome'])->name('akpk.home')->middleware('is_akpk');
Route::get('akpk/download', [PesananController::class, 'fileDownload'])->name('akpk.download')->middleware('is_akpk');
Route::get('akpk/legalisir', [PesananController::class, 'legalisir'])->name('akpk.legalisir')->middleware('is_akpk');
Route::get('akpk/legalisir/{legalisir:id}', [PesananController::class, 'detailLegalisir'])->name('akpk.legalisir.detail')->middleware('is_akpk');
Route::put('akpk/legalisir/{legalisir:id}', [PesananController::class, 'updateLegalisir'])->name('akpk.legalisir.detail')->middleware('is_akpk');

Route::get('akpk/surat', [PesananController::class, 'surat'])->name('akpk.surat')->middleware('is_akpk');
Route::get('akpk/surat/{surat:id}', [PesananController::class, 'detailSurat'])->name('akpk.surat.detail')->middleware('is_akpk');
Route::put('akpk/surat/{surat:id}', [PesananController::class, 'updateSurat'])->name('akpk.surat.detail')->middleware('is_akpk');

Route::get('akpk/lainnya', [PesananController::class, 'lainnya'])->name('akpk.lainnya')->middleware('is_akpk');
Route::get('akpk/lainnya/{lainnya:id}', [PesananController::class, 'detailLainnya'])->name('akpk.lainnya.detail')->middleware('is_akpk');
Route::put('akpk/lainnya/{lainnya:id}', [PesananController::class, 'updateLainnya'])->name('akpk.lainnya.detail')->middleware('is_akpk');

#dekan
route::get('dekan/home', [HomeController::class, 'adminHome'])->name('dekan.home')->middleware('is_dekan');
Route::get('dekan/download', [PesananController::class, 'fileDownload'])->name('dekan.download')->middleware('is_dekan');
Route::get('dekan/legalisir', [PesananController::class, 'legalisir'])->name('dekan.legalisir')->middleware('is_dekan');
Route::get('dekan/legalisir/{legalisir:id}', [PesananController::class, 'detailLegalisir'])->name('dekan.legalisir.detail')->middleware('is_dekan');
Route::put('dekan/legalisir/{legalisir:id}', [PesananController::class, 'updateLegalisir'])->name('dekan.legalisir.detail')->middleware('is_dekan');

Route::get('dekan/surat', [PesananController::class, 'surat'])->name('dekan.surat')->middleware('is_dekan');
Route::get('dekan/surat/{surat:id}', [PesananController::class, 'detailSurat'])->name('dekan.surat.detail')->middleware('is_dekan');
Route::put('dekan/surat/{surat:id}', [PesananController::class, 'updateSurat'])->name('dekan.surat.detail')->middleware('is_dekan');

Route::get('dekan/lainnya', [PesananController::class, 'lainnya'])->name('dekan.lainnya')->middleware('is_dekan');
Route::get('dekan/lainnya/{lainnya:id}', [PesananController::class, 'detailLainnya'])->name('dekan.lainnya.detail')->middleware('is_dekan');
Route::put('dekan/lainnya/{lainnya:id}', [PesananController::class, 'updateLainnya'])->name('dekan.lainnya.detail')->middleware('is_dekan');

#superadmin
Route::prefix('superadmin')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'superAdminHome'])->name('superadmin.home');

    Route::get('/akpk', [AkpkController::class, 'index'])->name('superadmin.akpk');
    Route::post('/akpk', [AkpkController::class, 'store']);
    Route::get('/akpk/create', [AkpkController::class, 'create'])->name('superadmin.akpk.create');

    Route::get('/dekan', [DekanController::class, 'index'])->name('superadmin.dekan');
    Route::post('/dekan', [DekanController::class, 'store']);
    Route::get('/dekan/create', [DekanController::class, 'create'])->name('superadmin.dekan.create');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/riwayat', [App\Http\Controllers\RiwayatController::class, 'index'])->name('riwayat');
Route::get('/riwayat/detail/{id}', [App\Http\Controllers\RiwayatController::class, 'detail']);
Route::get('/riwayat/ambil/{id}', [App\Http\Controllers\RiwayatController::class, 'ambil']);
Route::get('/download/{pesanan:id}', [App\Http\Controllers\RiwayatController::class, 'download'])->name('riwayat.download');

