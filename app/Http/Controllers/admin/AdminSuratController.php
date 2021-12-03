<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Suket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSuratController extends Controller
{
  public function surat(Request $request)
  {
    $surat = [];
    if ($request->has('status')) {
      $surat = Suket::where('verifikasi', $request->status)->get();
    } else {
      $surat = Suket::where('verifikasi', '1')->get();
    }

    return view('admin.index', [
      'type' => 'surat',
      'pesanan' => $surat->sortByDesc('updated_at'),
      'status' => $request->status
    ]);
  }

  public function detailSurat(Suket $surat)
  {
    $daftar_pesanan = collect([]);
    foreach ($surat->dokumen_dipesan as $values) {
      foreach ($values as $value) {
        $daftar_pesanan->put($value, 1);
      }
    }

    $user = User::where('nim', $surat->nim_pemesan)->first();

    return view('admin.detail', [
      'type' => 'surat',
      'pesanan' => $surat,
      'user' => $user,
      'daftar_pesanan' => $daftar_pesanan
    ]);
  }

  public function updateSurat(Suket $surat, Request $request)
  {
    $request->validate([
      'status' => 'required'
    ]);

    if ($request->status === '0') {
      $surat->komentar = $request->komentar;
    }

    if ($request->status == 3) {
      $surat->completed_at = now();
    }

    if ($surat->raw_tujuan ==2 && $surat->verifikasi == 2) {
      $request->validate([
        'biaya' => 'required'
      ]);

      $surat->biaya = $request->biaya;
    }

    $surat->verifikasi = $request->status;
    $surat->save();

    $adminTitle = auth()->user()->adminTitle();

    return redirect()->route($adminTitle . '.surat', ['status' => $request->status]);
  }
}
