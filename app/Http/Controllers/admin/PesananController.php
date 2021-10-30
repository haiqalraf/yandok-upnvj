<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lainya;
use Illuminate\Support\Facades\Storage;

class PesananController extends Controller
{
    public function lainnya(Request $request)
    {
        $lainnya = [];
        if ($request->has('status')) {
            if (auth()->user()->is_admin==2 && in_array($request->status, [0,1,2])) {
                $lainnya = Lainya::where('verifikasi', $request->status)->get();
                if (in_array($request->status,[2])) {
                    $lainnya = Lainya::where('verifikasi', $request->status)
                        ->orWhere('verifikasi', $request->status+1)->get();
                }
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
            'lainnya' => $lainnya->sortByDesc('updated_at'),
            'status' => $request->status
        ]);
    }

    public function detailLainnya(Lainya $lainnya)
    {
        if ((in_array($lainnya->verifikasi, [0,1]) && auth()->user()->is_admin==3)) {
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
    
                    $newName = $date . '_dok_dipesan_' . Str::slug($lainnya->dokumen_dipesan, '') . '_' . $username . '.' . $extension;
    
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
        } elseif ($request->status === '0') {
            if (auth()->user()->is_admin==2) {
                $lainnya->komentar = $request->komentar;
            } else {
                return back()->with("message", "You Don't Have Permission");
            }
        }

        $lainnya->verifikasi = $request->status;
        $lainnya->save();

        if (auth()->user()->is_admin==2) {
            return redirect()->route('akpk.lainnya', ['status' => $request->status]);
        } elseif (auth()->user()->is_admin==3) {
            return redirect()->route('dekan.lainnya', ['status' => $request->status-1]);
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
