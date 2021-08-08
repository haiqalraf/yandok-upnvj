<?php

namespace App\Http\Controllers;

use App\Models\Suket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('suket.surat');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $suket_pengganti = new Suket;
        $suket_perubahan = new Suket;
        $suket_ralat = new Suket;
        $suket_alumni = new Suket;

        $file_pengganti = "";
        $file_perubahan = "";
        $file_ralat = "";
        $file_alumni = "";

        if (!empty($request->jenis_pengganti)) {
            $request->validate([
                'upload_pengganti' => 'required|file|mimes:zip,rar'
            ]);

            if ($request->hasFile('upload_pengganti')) {
                $file = $request->file("upload_pengganti");
    
                $extension = $file->getClientOriginalExtension();
                $username = auth()->user()->name;
                $date = now("Asia/Jakarta")->format('YmdHis');
    
                $file_pengganti = $date . '_persyaratan_'.Str::slug($request->jenis_pengganti,'').'_' . $username . '.' . $extension;

                $suket_pengganti->nim_pemesan = auth()->user()->nim;
                $suket_pengganti->dokumen_dipesan = $request->jenis_pengganti;
                $suket_pengganti->file = $file_pengganti;
            } else {
                return back()->with("message", "File Not Found");
            }
        }

        if (!empty($request->jenis_perubahan)) {
            $request->validate([
                'upload_perubahan_ralat' => 'required|file|mimes:zip,rar'
            ]);

            if ($request->hasFile('upload_perubahan_ralat')) {
                $file = $request->file("upload_perubahan_ralat");
    
                $extension = $file->getClientOriginalExtension();
                $username = auth()->user()->name;
                $date = now("Asia/Jakarta")->format('YmdHis');
    
                $file_perubahan = $date . '_'.Str::slug($request->jenis_perubahan,'').'_' . $username . '.' . $extension;

                $suket_perubahan->nim_pemesan = auth()->user()->nim;
                $suket_perubahan->dokumen_dipesan = $request->jenis_perubahan;
                $suket_perubahan->file = $file_perubahan;
            } else {
                return back()->with("message", "File Not Found");
            }
        }

        if (!empty($request->jenis_ralat)) {
            $request->validate([
                'upload_perubahan_ralat' => 'required|file|mimes:zip,rar'
            ]);

            if ($request->hasFile('upload_perubahan_ralat')) {
                $file = $request->file("upload_perubahan_ralat");
    
                $extension = $file->getClientOriginalExtension();
                $username = auth()->user()->name;
                $date = now("Asia/Jakarta")->format('YmdHis');
    
                $file_ralat = $date . '_'.Str::slug($request->jenis_ralat,'').'_' . $username . '.' . $extension;

                $suket_ralat->nim_pemesan = auth()->user()->nim;
                $suket_ralat->dokumen_dipesan = $request->jenis_ralat;
                $suket_ralat->file = $file_ralat;
            } else {
                return back()->with("message", "File Not Found");
            }
        }
        
        if (!empty($request->jenis_alumni)) {
            $request->validate([
                'upload_alumni' => 'required|file|mimes:zip,rar'
            ]);

            if ($request->hasFile('upload_alumni')) {
                $file = $request->file("upload_alumni");
    
                $extension = $file->getClientOriginalExtension();
                $username = auth()->user()->name;
                $date = now("Asia/Jakarta")->format('YmdHis');
    
                $file_alumni = $date . '_'.Str::slug($request->jenis_alumni,'').'_' . $username . '.' . $extension;

                $suket_alumni->nim_pemesan = auth()->user()->nim;
                $suket_alumni->dokumen_dipesan = $request->jenis_alumni;
                $suket_alumni->file = $file_alumni;
            } else {
                return back()->with("message", "File Not Found");
            }
        }

        if (!Storage::disk('local')->exists('suket/' . $file_pengganti) && !empty($file_pengganti)) {
            Storage::disk('local')->put('suket/' . $file_pengganti, $request->file('upload_pengganti')->get());
            $suket_pengganti->save();
        }

        if (!Storage::disk('local')->exists('suket/' . $file_perubahan) && !empty($file_perubahan)) {
            Storage::disk('local')->put('suket/' . $file_perubahan, $request->file('upload_perubahan_ralat')->get());
            $suket_perubahan->save();
        }

        if (!Storage::disk('local')->exists('suket/' . $file_ralat) && !empty($file_ralat)) {
            Storage::disk('local')->put('suket/' . $file_ralat, $request->file('upload_perubahan_ralat')->get());
            $suket_ralat->save();
        }
        
        if (!Storage::disk('local')->exists('suket/' . $file_alumni) && !empty($file_alumni)) {
            Storage::disk('local')->put('suket/' . $file_alumni, $request->file('upload_alumni')->get());
            $suket_alumni->save();
        }
        
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suket  $suket
     * @return \Illuminate\Http\Response
     */
    public function show(Suket $suket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suket  $suket
     * @return \Illuminate\Http\Response
     */
    public function edit(Suket $suket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suket  $suket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suket $suket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suket  $suket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suket $suket)
    {
        //
    }
}
