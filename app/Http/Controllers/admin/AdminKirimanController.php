<?php

namespace App\Http\Controllers\admin;

use App\Models\Suket;
use App\Models\Lainya;
use App\Models\Legalisir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminKirimanController extends Controller
{
    public function index(Request $request)
    {
        $kebutuhan = ['ASN', 'TNI atau Polri'];
        if (auth()->user()->is_admin == 3) {
            $kebutuhan = ['Swasta', 'Lainnya'];
        }
        if (!$request->has('status')) {
            $request->status = '1';
        }
        
        $legalisir = Legalisir::with('user:nim,name')->where(function ($query) use ($request, $kebutuhan) {
            $query->where('verifikasi_pengiriman', $request->status)->where('kebutuhan', $kebutuhan[0])->where('tujuan', "2")->where('verifikasi', "3");
        })->orWhere(function ($query) use ($request, $kebutuhan) {
            $query->where('verifikasi_pengiriman', $request->status)->where('kebutuhan', $kebutuhan[1])->where('tujuan', "2")->where('verifikasi', "3");
        })->get();

        $pesanan = $legalisir;

        if (auth()->user()->is_admin == 2) {
            $lainnya = Lainya::with('user:nim,name')->where('verifikasi_pengiriman', $request->status)->where('verifikasi', "3")->get();
            
            $surat = Suket::with('user:nim,name')->where('verifikasi_pengiriman', $request->status)->where('verifikasi', "3")->get();

            $pesanan = $pesanan->concat($lainnya)->concat($surat);
        }
        
        $pesanan->sortByDesc('updated_at');

        return view('admin.kiriman.index', [
            'pesanan' => $pesanan,
            'status' => $request->status
        ]);
    }

    private function pesanan($pesanan, Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $pesanan->verifikasi_pengiriman = $request->status;
        $pesanan->save();
    }

    public function legalisir(Legalisir $legalisir, Request $request)
    {
        $this->pesanan($legalisir, $request);

        return redirect()->route(auth()->user()->adminTitle().'.kiriman', ['status' => $request->status]);
    }

    public function lainnya(Lainya $lainnya, Request $request)
    {
        $this->pesanan($lainnya, $request);

        return redirect()->route(auth()->user()->adminTitle() . '.kiriman', ['status' => $request->status]);
    }

    public function surat(Suket $surat, Request $request)
    {
        $this->pesanan($surat, $request);

        return redirect()->route(auth()->user()->adminTitle() . '.kiriman', ['status' => $request->status]);
    }
}
