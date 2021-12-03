<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Lainya;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminLainnyaController extends Controller
{
    public function lainnya(Request $request)
    {
        $lainnya = [];
        if ($request->has('status')) {
            $lainnya = Lainya::where('verifikasi', $request->status)->get();
        } else {
            $lainnya = Lainya::where('verifikasi', '1')->get();
        }

        return view('admin.index', [
            'type' => 'lainnya',
            'pesanan' => $lainnya->sortByDesc('updated_at'),
            'status' => $request->status
        ]);
    }

    public function detailLainnya(Lainya $lainnya)
    {
        $daftar_pesanan = collect([]);
        $daftar_pesanan->put($lainnya->dokumen_dipesan, 1);
        $user = User::where('nim', $lainnya->nim_pemesan)->first();
        return view('admin.detail', [
            'type' => 'lainnya',
            'pesanan' => $lainnya,
            'user' => $user,
            'daftar_pesanan' => $daftar_pesanan
        ]);
    }

    public function updateLainnya(Lainya $lainnya, Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);

        if ($request->status === '0') {
            $lainnya->komentar = $request->komentar;
        }

        if ($request->status == 3) {
            $lainnya->completed_at = now();
        }

        if ($lainnya->raw_tujuan == 2 && $lainnya->verifikasi==2) {
            $request->validate([
                'biaya' => 'required'
            ]);

            $lainnya->biaya = $request->biaya;
        }

        $lainnya->verifikasi = $request->status;
        $lainnya->save();

        $adminTitle = auth()->user()->adminTitle();

        return redirect()->route($adminTitle.'.lainnya', ['status' => $request->status]);
    }
}
