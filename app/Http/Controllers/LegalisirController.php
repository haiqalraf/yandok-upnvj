<?php

namespace App\Http\Controllers;

use App\Models\Legalisir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LegalisirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function _construct()
    {
        $this->middleware('auth');
    }
    */
    public function index()
    {
        //
        return view('legalisir.index');
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
        $request->validate([
            'dok_01' => 'required|numeric',
            'dok_02' => 'required|numeric',
            'dok_03' => 'required|numeric',
            'dok_04' => 'required|numeric',
            'dok_05' => 'required|numeric',
            'dok_06' => 'required|numeric',
            'dok_07' => 'required|numeric',
            'dok_08' => 'required|numeric',
            'dok_09' => 'required|numeric',
            'dok_10' => 'required|numeric',
            'dok_11' => 'required|numeric',
            'dok_12' => 'required|numeric',
            'file' => 'required|file|mimes:zip,rar',
            'kebutuhan' => 'required'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file("file");

            $extension = $file->getClientOriginalExtension();
            $username = auth()->user()->name;
            $date = now("Asia/Jakarta")->format('YmdHis');

            $newName = $date . '_ijazah_' . $username . '.' . $extension;

            if (!Storage::disk('local')->exists('legalisir/' . $newName)) {
                Storage::disk('local')->put('legalisir/' . $newName, $file->get());
            }

            Legalisir::create([
				'nim_pemesan' => auth()->user()->nim,
                'dok_01' => $request->dok_01,
                'dok_02' => $request->dok_02,
                'dok_03' => $request->dok_03,
                'dok_04' => $request->dok_04,
                'dok_05' => $request->dok_05,
                'dok_06' => $request->dok_06,
                'dok_07' => $request->dok_07,
                'dok_08' => $request->dok_08,
                'dok_09' => $request->dok_09,
                'dok_10' => $request->dok_10,
                'dok_11' => $request->dok_11,
                'dok_12' => $request->dok_12,
                'file' => $newName,
                'kebutuhan' => $request->kebutuhan,
                'keterangan' => $request->keterangan
            ]);
            return redirect('/home');
        } else {
            return back()->with("message", "File Not Found");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Legalisir  $legalisir
     * @return \Illuminate\Http\Response
     */
    public function show(Legalisir $legalisir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Legalisir  $legalisir
     * @return \Illuminate\Http\Response
     */
    public function edit(Legalisir $legalisir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Legalisir  $legalisir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Legalisir $legalisir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Legalisir  $legalisir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Legalisir $legalisir)
    {
        //
    }
}
