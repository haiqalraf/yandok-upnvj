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

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('admin/download', [PesananController::class, 'fileDownload'])->name('admin.download')->middleware('is_admin');
Route::get('admin/legalisir', [PesananController::class, 'legalisir'])->name('admin.legalisir')->middleware('is_admin');
Route::get('admin/legalisir/{legalisir:id}', [PesananController::class, 'detailLegalisir'])->name('admin.legalisir.detail')->middleware('is_admin');
Route::put('admin/legalisir/{legalisir:id}', [PesananController::class, 'updateLegalisir'])->name('admin.legalisir.detail')->middleware('is_admin');

Route::get('admin/surat', [PesananController::class, 'surat'])->name('admin.surat')->middleware('is_admin');
Route::get('admin/surat/{surat:id}', [PesananController::class, 'detailSurat'])->name('admin.surat.detail')->middleware('is_admin');
Route::put('admin/surat/{surat:id}', [PesananController::class, 'updateSurat'])->name('admin.surat.detail')->middleware('is_admin');

Route::get('admin/lainnya', [PesananController::class, 'lainnya'])->name('admin.lainnya')->middleware('is_admin');
Route::get('admin/lainnya/{lainnya:id}', [PesananController::class, 'detailLainnya'])->name('admin.lainnya.detail')->middleware('is_admin');
Route::put('admin/lainnya/{lainnya:id}', [PesananController::class, 'updateLainnya'])->name('admin.lainnya.detail')->middleware('is_admin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tracestudy', [App\Http\Controllers\HomeController::class, 'tracestudy'])->name('tracestudy');
Route::post('/tracestudy', [App\Http\Controllers\HomeController::class, 'updateTracer']);
Route::get('/riwayat', [App\Http\Controllers\RiwayatController::class, 'index'])->name('riwayat');
Route::get('/riwayat/detail/{id}', [App\Http\Controllers\RiwayatController::class, 'detail']);
Route::get('/riwayat/ambil/{id}', [App\Http\Controllers\RiwayatController::class, 'ambil']);
Route::get('/download/{pesanan:id}', [App\Http\Controllers\RiwayatController::class, 'download'])->name('riwayat.download');