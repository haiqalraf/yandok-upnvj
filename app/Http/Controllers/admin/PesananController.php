<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Suket;
use App\Models\Legalisir;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lainya;
use Illuminate\Support\Facades\Storage;

class PesananController extends Controller
{
    public function legalisir(Request $request)
    {
        $legalisir = [];
        if ($request->has('status')) {
            if (auth()->user()->is_admin==2 && $request->status===1) {
                $legalisir = Legalisir::where('verifikasi', $request->status)->get();
            } elseif(auth()->user()->is_admin==3 && in_array($request->status, [1,2])) {
                $legalisir = Legalisir::where('verifikasi', $request->status+1)->get();
            }
        } else {
            if (auth()->user()->is_admin==2) {
                $legalisir = Legalisir::where('verifikasi', '1')->get();
            } elseif(auth()->user()->is_admin==3) {
                $legalisir = Legalisir::where('verifikasi', '2')->get();
            }
        }

        return view('admin.legalisir.index', [
            'legalisir' => $legalisir,
            'status' => $request->status
        ]);
    }

    public function detailLegalisir(Legalisir $legalisir)
    {
        if (($legalisir->verifikasi===1 && auth()->user()->is_admin==3) || (in_array($legalisir->verifikasi, [2,3]) && auth()->user()->is_admin==2)) {
            return abort('404'); 
        }
        $daftar_pesanan = collect([]);
        if ($legalisir->dok_01 > 0) {
            $daftar_pesanan->put('Legalisir Ijazah', $legalisir->dok_01);
        }
        if ($legalisir->dok_02 > 0) {
            $daftar_pesanan->put('Legalisir Transkrip', $legalisir->dok_02);
        }
        if ($legalisir->dok_03 > 0) {
            $daftar_pesanan->put('Legalisir Piagam Cum Laude', $legalisir->dok_03);
        }
        if ($legalisir->dok_04 > 0) {
            $daftar_pesanan->put('Terjemahan Ijazah', $legalisir->dok_04);
        }
        if ($legalisir->dok_05 > 0) {
            $daftar_pesanan->put('Terjemahan Transkrip', $legalisir->dok_05);
        }
        if ($legalisir->dok_06 > 0) {
            $daftar_pesanan->put('Terjemahan Piagam Cumlaude', $legalisir->dok_06);
        }
        if ($legalisir->dok_07 > 0) {
            $daftar_pesanan->put('Legalisir Akreditasi Program Studi (Tanggal Lulus)', $legalisir->dok_07);
        }
        if ($legalisir->dok_08 > 0) {
            $daftar_pesanan->put('Legalisir Akreditasi Program Studi (Saat Ini)', $legalisir->dok_08);
        }
        if ($legalisir->dok_09 > 0) {
            $daftar_pesanan->put('Legalisir Akreditasi Institusi (Tanggal Lulus)', $legalisir->dok_09);
        }
        if ($legalisir->dok_10 > 0) {
            $daftar_pesanan->put('Legalisir Akreditasi Institusi (Saat Ini)', $legalisir->dok_10);
        }
        if ($legalisir->dok_11 > 0) {
            $daftar_pesanan->put('Legalisir Akreditasi Program Profesi - Spesialis (Tanggal Lulus)', $legalisir->dok_11);
        }
        if ($legalisir->dok_12 > 0) {
            $daftar_pesanan->put('Legalisir Akreditasi Program Profesi - Spesialis (Saat Ini)', $legalisir->dok_12);
        }

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

        if ($request->status === '3') {
            if (auth()->user()->is_admin==3) {
                $request->validate([
                    'upload' => 'required|file|mimes:zip,rar'
                ]);
    
                if ($request->hasFile('upload')) {
                    $file = $request->file("upload");
    
                    $extension = $file->getClientOriginalExtension();
                    $username = User::where('nim', $legalisir->nim_pemesan)->first()->name;
                    $date = now("Asia/Jakarta")->format('YmdHis');
    
                    $newName = $date . '_' . 'legalisir' . '_' . $username . '.' . $extension;
    
                    if (!Storage::disk('local')->exists('legalisir/selesai/' . $newName)) {
                        Storage::disk('local')->put('legalisir/selesai/' . $newName, $file->get());
                    }
    
                    $legalisir->final_dokumen = $newName;
                } else {
                    return back()->with("message", "File Not Found");
                }
            } else {
                return back()->with("message", "You Don't Have Permission");
            }
        }
        
        $legalisir->verifikasi = $request->status;
        $legalisir->save();
        if (auth()->user()->is_admin==2) {
            return redirect()->route('akpk.legalisir', ['status' => $request->status]);
        } elseif (auth()->user()->is_admin==3) {
            return redirect()->route('dekan.legalisir', ['status' => $request->status-1]);
        }
    }

    public function surat(Request $request)
    {
        $surat = [];
        if ($request->has('status')) {
            if (auth()->user()->is_admin==2 && $request->status===1) {
                $surat = Suket::where('verifikasi', $request->status)->get();
            } elseif(auth()->user()->is_admin==3 && in_array($request->status, [1,2])) {
                $surat = Suket::where('verifikasi', $request->status+1)->get();
            }
        } else {
            if (auth()->user()->is_admin==2) {
                $surat = Suket::where('verifikasi', '1')->get();
            } elseif(auth()->user()->is_admin==3) {
                $surat = Suket::where('verifikasi', '2')->get();
            }
        }
        
        return view('admin.surat.index', [
            'surat' => $surat,
            'status' => $request->status
        ]);
    }

    public function detailSurat(Suket $surat)
    {
        if (($surat->verifikasi===1 && auth()->user()->is_admin==3) || (in_array($surat->verifikasi, [2,3]) && auth()->user()->is_admin==2)) {
            return abort('404'); 
        }
        $daftar_pesanan = collect([]);
        $daftar_pesanan->put($surat->dokumen_dipesan, 1);

        return view('admin.surat.detail', [
            'surat' => $surat,
            'daftar_pesanan' => $daftar_pesanan
        ]);
    }

    public function updateSurat(Suket $surat, Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);

        if ($request->status === '3') {
            if (auth()->user()->is_admin==3) {
                $request->validate([
                    'upload' => 'required|file|mimes:zip,rar'
                ]);
    
                if ($request->hasFile('upload')) {
                    $file = $request->file("upload");
    
                    $extension = $file->getClientOriginalExtension();
                    $username = User::where('nim', $surat->nim_pemesan)->first()->name;
                    $date = now("Asia/Jakarta")->format('YmdHis');
    
                    $newName = $date . '_' . Str::slug($surat->dokumen_dipesan, '') . '_' . $username . '.' . $extension;
    
                    if (!Storage::disk('local')->exists('suket/selesai/' . $newName)) {
                        Storage::disk('local')->put('suket/selesai/' . $newName, $file->get());
                    }
    
                    $surat->final_dokumen = $newName;
                } else {
                    return back()->with("message", "File Not Found");
                }
            } else {
                return back()->with("message", "You Don't Have Permission");
            }
        }

        $surat->verifikasi = $request->status;
        $surat->save();

        if (auth()->user()->is_admin==2) {
            return redirect()->route('akpk.surat', ['status' => $request->status]);
        } elseif (auth()->user()->is_admin==3) {
            return redirect()->route('dekan.surat', ['status' => $request->status]);
        }
    }

    public function lainnya(Request $request)
    {
        $lainnya = [];
        if ($request->has('status')) {
            if (auth()->user()->is_admin==2 && $request->status===1) {
                $lainnya = Lainya::where('verifikasi', $request->status)->get();
            } elseif(auth()->user()->is_admin==3 && in_array($request->status, ['1','2'])) {
                $lainnya = Lainya::where('verifikasi', $request->status+1)->get();
            }
        } else {
            if (auth()->user()->is_admin==2) {
                $lainnya = Lainya::where('verifikasi', '1')->get();
            } elseif(auth()->user()->is_admin==3) {
                $lainnya = Lainya::where('verifikasi', '2')->get();
            }
        }
        
        return view('admin.lainnya.index', [
            'lainnya' => $lainnya,
            'status' => $request->status
        ]);
    }

    public function detailLainnya(Lainya $lainnya)
    {
        if (($lainnya->verifikasi===1 && auth()->user()->is_admin==3) || (in_array($lainnya->verifikasi, [2,3]) && auth()->user()->is_admin==2)) {
            return abort('404'); 
        }
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

        if ($request->status === '3') {
            if (auth()->user()->is_admin==3) {
                $request->validate([
                    'upload' => 'required|file|mimes:zip,rar'
                ]);
                if ($request->hasFile('upload')) {
                    $file = $request->file("upload");
    
                    $extension = $file->getClientOriginalExtension();
                    $username = User::where('nim', $lainnya->nim_pemesan)->first()->name;
                    $date = now("Asia/Jakarta")->format('YmdHis');
    
                    $newName = $date . '_' . Str::slug($lainnya->dokumen_dipesan, '') . '_' . $username . '.' . $extension;
    
                    if (!Storage::disk('local')->exists('lainnya/selesai/' . $newName)) {
                        Storage::disk('local')->put('lainnya/selesai/' . $newName, $file->get());
                    }
    
                    $lainnya->final_dokumen = $newName;
                } else {
                    return back()->with("message", "File Not Found");
                }
            } else {
                return back()->with("message", "You Don't Have Permission");
            }

        }

        $lainnya->verifikasi = $request->status;
        $lainnya->save();

        if (auth()->user()->is_admin==2) {
            return redirect()->route('akpk.lainnya', ['status' => $request->status]);
        } elseif (auth()->user()->is_admin==3) {
            return redirect()->route('dekan.lainnya', ['status' => $request->status]);
        }
    }

    public function fileDownload(Request $request)
    {
        $filePath = $request->filePath;

        if (!Storage::disk('local')->exists($filePath)) {
            abort('404'); 
        }

        return response()->download(storage_path('app' . DIRECTORY_SEPARATOR . ($filePath)), Str::of($filePath)->basename(), [], 'inline');

    }
}
