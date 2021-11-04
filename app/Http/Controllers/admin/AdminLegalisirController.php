<?php

namespace App\Http\Controllers\admin;

use App\Models\Legalisir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminLegalisirController extends Controller
{
  public function legalisir(Request $request)
  {
      $legalisir = [];
      if ($request->has('status')) {
        if (auth()->user()->is_admin==2) {
          $legalisir = Legalisir::where('verifikasi', $request->status)
            ->where('kebutuhan', 'ASN')->orWhere('kebutuhan', 'TNI atau Polri')->get();
        } elseif (auth()->user()->is_admin==3) {
        $legalisir = Legalisir::where('verifikasi', $request->status)
          ->where('kebutuhan', 'Swasta')->orWhere('kebutuhan', 'Lainnya')->get();
        }
      } else {
        if (auth()->user()->is_admin == 2) {
          $legalisir = Legalisir::where('verifikasi', 1)
            ->where('kebutuhan', 'ASN')->orWhere('kebutuhan', 'TNI atau Polri')->get();
        } elseif (auth()->user()->is_admin == 3) {
          $legalisir = Legalisir::where('verifikasi', 1)
          ->where('kebutuhan', 'Swasta')->orWhere('kebutuhan', 'Lainnya')->get();
        }
      }

      if (auth()->user()->is_admin==3) {
        $legalisir = $legalisir->filter(function ($value, $key) {
          return User::where('nim', $value->nim_pemesan)->first()->fakultas === auth()->user()->fakultas;
        });
      }

      return view('admin.legalisir.index', [
          'legalisir' => $legalisir->sortByDesc('updated_at'),
          'status' => $request->status
      ]);
  }

  public function detailLegalisir(Legalisir $legalisir)
  {
    if ($legalisir->isKebutuhanForAkpk() && auth()->user()->is_admin == 3) {
      abort('404');
    }
      $daftar_pesanan = $legalisir->daftarPesanan();

      return view('admin.legalisir.detail', [
          'legalisir' => $legalisir,
          'daftar_pesanan' => $daftar_pesanan
      ]);
  }

  public function updateLegalisir(Legalisir $legalisir, Request $request)
  {
    if ($legalisir->isKebutuhanForAkpk() && auth()->user()->is_admin == 3) {
      abort('404');
    }
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