<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\admin\PesananController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuketController;
use App\Http\Controllers\LainyaController;
use App\Http\Controllers\LegalisirController;
use App\Http\Controllers\ApiController;
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
Route::get('akpk/home', [HomeController::class, 'akpkHome'])->name('akpk.home')->middleware('is_akpk');
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
route::get('dekan/home', [HomeController::class, 'dekanHome'])->name('dekan.home')->middleware('is_dekan');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/riwayat', [App\Http\Controllers\RiwayatController::class, 'index'])->name('riwayat');
Route::get('/riwayat/detail/{id}', [App\Http\Controllers\RiwayatController::class, 'detail']);
Route::get('/riwayat/ambil/{id}', [App\Http\Controllers\RiwayatController::class, 'ambil']);
Route::get('/download/{pesanan:id}', [App\Http\Controllers\RiwayatController::class, 'download'])->name('riwayat.download');

