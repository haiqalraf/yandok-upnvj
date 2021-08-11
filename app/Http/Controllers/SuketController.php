<?php

namespace App\Http\Controllers;

use App\Models\Suket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'upload.1' => [
                Rule::requiredIf(
                    $request->filled('pesan.jenis_pengganti')
                ),
                'file',
                'mimes:rar,zip'
            ],
            'upload.2' => [
                Rule::requiredIf(
                    ($request->filled('pesan.jenis_perubahan'))
                    || ($request->filled('pesan.jenis_ralat'))
                ), 
                'file',
                'mimes:zip,rar'
            ],
            'upload.3' => [
                Rule::requiredIf($request->filled('pesan.jenis_alumni')), 
                'file',
                'mimes:zip,rar'
            ],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $suket = new Suket;
        $suket->nim_pemesan = auth()->user()->nim;
        $dokumen = $suket->dokumen_dipesan;
        $files = $suket->file;
        foreach ($request->pesan as $keys => $values) {
            foreach ($values as $key => $value) {
                $dokumen[$keys][$key] = $value;
                $key_file = 0;
                $filename = '';
                if ($keys == 'jenis_pengganti') {
                    $key_file = 1;
                } else if ($keys == 'jenis_perubahan' || $keys == 'jenis_ralat') {
                    $key_file = 2;
                } else if ($keys == 'jenis_alumni') {
                    $key_file = 3;
                }

                if ($request->hasFile('upload.'.$key_file)) {
                    $file = $request->file("upload.".$key_file);
        
                    $extension = $file->getClientOriginalExtension();
                    $username = auth()->user()->name;
                    $date = now("Asia/Jakarta")->format('YmdHis');
        
                    $filename = $date . '_persyaratan_'.Str::slug($value,'').'_' . $username . '.' . $extension;
                    $files[$key_file] = $filename;
                } else {
                    return back()->with("message", "File Not Found");
                }
    
                if (!Storage::disk('local')->exists('suket/' .$filename ) && !empty($filename)) {
                    Storage::disk('local')->put('suket/' . $filename, $request->file('upload.'.$key_file)->get());
                }
            }
        }
        $suket->dokumen_dipesan = $dokumen;
        $suket->file = $files;
        $suket->save();
        
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
