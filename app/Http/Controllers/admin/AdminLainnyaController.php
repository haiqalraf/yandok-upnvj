<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lainya;
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
        
        return view('admin.lainnya.index', [
            'lainnya' => $lainnya->sortByDesc('updated_at'),
            'status' => $request->status
        ]);
    }

    public function detailLainnya(Lainya $lainnya)
    {
        $daftar_pesanan = collect([]);
        $daftar_pesanan->put($lainnya->dokumen_dipesan, 1);
        return view('admin.lainnya.detail', [
            'lainnya' => $lainnya,
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

        $lainnya->verifikasi = $request->status;
        $lainnya->save();

        $adminTitle = auth()->user()->adminTitle();

        return redirect()->route($adminTitle.'.lainnya', ['status' => $request->status]);
    }
}
