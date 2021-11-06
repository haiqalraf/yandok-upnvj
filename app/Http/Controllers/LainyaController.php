<?php

namespace App\Http\Controllers;

use App\Models\Lainya;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LainyaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document = Lainya::where('nim_pemesan', auth()->user()->nim)->where('verifikasi', 0)->get();

        return view('lainnya.lainnya', ['document' => $document]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lainnya.formpengajuan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'dokumen_dipesan' => 'required',
            'jumlah_dokumen' => 'required|numeric',
            'file' => 'required|file|mimes:zip,rar',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file("file");

            $extension = $file->getClientOriginalExtension();
            $username = auth()->user()->name;
            $date = now("Asia/Jakarta")->format('YmdHis');

            $newName = $date . '_persyaratan_'.Str::slug($request->dokumen_dipesan, '').'_' . $username . '.' . $extension;

            if (!Storage::disk('local')->exists('lainnya/' . $newName)) {
                Storage::disk('local')->put('lainnya/' . $newName, $file->get());
            }

            Lainya::create([
                'nim_pemesan' => auth()->user()->nim,
                'dokumen_dipesan' => $request->dokumen_dipesan,
                'jumlah_dokumen' => $request->jumlah_dokumen,
                'file' => $newName,
                'verifikasi' => 0
            ]);
            return redirect()->route('lainnya');
        } else {
            return back()->with("message", "File Not Found");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lainya  $lainya
     * @return \Illuminate\Http\Response
     */
    public function show(Lainya $lainya)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lainya  $lainya
     * @return \Illuminate\Http\Response
     */
    public function edit(/*Lainya $lainya*/)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lainya  $lainya
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lainya $lainya)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lainya  $lainya
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lainya $lainya)
    {
        //
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'tujuan' => 'required',
        ]);

        Validator::make($request->all(), [
            'alamat' => Rule::requiredIf(function () use ($request) {
                return $request->tujuan == 2;
            }),
        ])->validate();

        foreach ($request->item as $key => $value) {
            if ($value != 0) {
                $lainnya = Lainya::find($key);
                $lainnya->jumlah_dokumen = $value;
                $lainnya->verifikasi = 1;
                $lainnya->tujuan = (int)$request->tujuan;
                $lainnya->alamat = ($request->alamat ? $request->alamat : null);
                $lainnya->save();
            }
        }

        return redirect('/riwayat');
    }
}
