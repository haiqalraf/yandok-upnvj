<?php

namespace App\Http\Controllers\admin;

use App\Models\Legalisir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLegalisirController extends Controller
{
  public function legalisir(Request $request)
  {
      $legalisir = [];
      if ($request->has('status')) {
          $legalisir = Legalisir::where('verifikasi', $request->status)->get();
      } else {
          $legalisir = Legalisir::where('verifikasi', '1')->get();
      }

      return view('admin.legalisir.index', [
          'legalisir' => $legalisir->sortByDesc('updated_at'),
          'status' => $request->status
      ]);
  }

  public function detailLegalisir(Legalisir $legalisir)
  {
      $daftar_pesanan = $legalisir->daftarPesanan();

      return view('admin.legalisir.detail', [
          'legalisir' => $legalisir,
          'daftar_pesanan' => $daftar_pesanan
      ]);
  }

  public function updateLegalisir(Legalisir $legalisir, Request $request)
  {
      $request->validate([
          'status' => 'required'
      ]);

      if ($request->status === '0') {
          $legalisir->komentar = $request->komentar;
      }
      
      $legalisir->verifikasi = $request->status;
      $legalisir->save();
      $adminTitle = auth()->user()->adminTitle();
      return redirect()->route($adminTitle.'.legalisir', ['status' => $request->status]);
  }
}