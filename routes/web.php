<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuketController;
use App\Http\Controllers\LainyaController;
use App\Http\Controllers\LegalisirController;
use App\Http\Controllers\admin\PesananController;
use App\Http\Controllers\admin\DownloadController;
use App\Http\Controllers\superadmin\AkpkController;
use App\Http\Controllers\admin\AdminSuratController;
use App\Http\Controllers\superadmin\DekanController;
use App\Http\Controllers\admin\AdminLainnyaController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\admin\AdminLegalisirController;

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

Route::get('/password/edit', [ResetPasswordController::class, 'showResetFormWithoutToken'])->middleware('auth')->name('password.edit');
Route::post('/password/edit', [ResetPasswordController::class, 'updatePasswordFromOldPassword'])->middleware('auth')->name('password.update-auth');
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

#akpk
Route::prefix('akpk')->middleware('is_akpk')->group(function ()
{
    Route::get('/download', [DownloadController::class, 'fileDownload'])->name('akpk.download');
    Route::get('/legalisir', [AdminLegalisirController::class, 'legalisir'])->name('akpk.legalisir');
    Route::get('/legalisir/{legalisir:id}', [AdminLegalisirController::class, 'detailLegalisir'])->name('akpk.legalisir.detail');
    Route::put('/legalisir/{legalisir:id}', [AdminLegalisirController::class, 'updateLegalisir'])->name('akpk.legalisir.detail');
    
    Route::get('/surat', [AdminSuratController::class, 'surat'])->name('akpk.surat');
    Route::get('/surat/{surat:id}', [AdminSuratController::class, 'detailSurat'])->name('akpk.surat.detail');
    Route::put('/surat/{surat:id}', [AdminSuratController::class, 'updateSurat'])->name('akpk.surat.detail');
    
    Route::get('/lainnya', [AdminLainnyaController::class, 'lainnya'])->name('akpk.lainnya');
    Route::get('/lainnya/{lainnya:id}', [AdminLainnyaController::class, 'detailLainnya'])->name('akpk.lainnya.detail');
    Route::put('/lainnya/{lainnya:id}', [AdminLainnyaController::class, 'updateLainnya'])->name('akpk.lainnya.detail');
});

#dekan
Route::prefix('dekan')->middleware('is_dekan')->group(function ()
{
    Route::get('/download', [DownloadController::class, 'fileDownload'])->name('dekan.download');
    Route::get('/legalisir', [AdminLegalisirController::class, 'legalisir'])->name('dekan.legalisir');
    Route::get('/legalisir/{legalisir:id}', [AdminLegalisirController::class, 'detailLegalisir'])->name('dekan.legalisir.detail');
    Route::put('/legalisir/{legalisir:id}', [AdminLegalisirController::class, 'updateLegalisir'])->name('dekan.legalisir.detail');
});

#superadmin
Route::prefix('superadmin')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('superadmin.home');

    Route::get('/akpk', [AkpkController::class, 'index'])->name('superadmin.akpk');
    Route::post('/akpk', [AkpkController::class, 'store']);
    Route::get('/akpk/create', [AkpkController::class, 'create'])->name('superadmin.akpk.create');
    Route::post('/akpk/delete', [AkpkController::class, 'delete'])->name('superadmin.akpk.delete');

    Route::get('/dekan', [DekanController::class, 'index'])->name('superadmin.dekan');
    Route::post('/dekan', [DekanController::class, 'store']);
    Route::get('/dekan/create', [DekanController::class, 'create'])->name('superadmin.dekan.create');
    Route::post('/dekan/delete', [DekanController::class, 'delete'])->name('superadmin.dekan.delete');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tracestudy', [App\Http\Controllers\HomeController::class, 'tracestudy'])->name('tracestudy');
Route::get('/riwayat', [App\Http\Controllers\RiwayatController::class, 'index'])->name('riwayat');
Route::get('/riwayat/detail/{id}', [App\Http\Controllers\RiwayatController::class, 'detail']);
Route::get('/riwayat/ambil/{id}', [App\Http\Controllers\RiwayatController::class, 'ambil']);
Route::get('/download/{pesanan:id}', [App\Http\Controllers\RiwayatController::class, 'download'])->name('riwayat.download');
Route::get('/bayar', function ()
{
    return view('riwayat.bukti-bayar');
});

