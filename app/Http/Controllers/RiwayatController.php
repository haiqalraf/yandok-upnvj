<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Legalisir;
use App\Models\Suket;
use App\Models\Lainya;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RiwayatController extends Controller
{
    //
    public function index()
    {
        $nim = auth()->user()->nim;
        
        try {

            $arr = array();
            $Pesanan = new Pesanan();
            $results = $Pesanan->getData($nim);

            foreach ($results as $result) {

                if ($result->verifikasi == 1){

                    $result->badge = 'badge-warning';
                    $result->verifikasi = 'Proses';
                    $result->pesanan = false;

                } elseif ($result->verifikasi == 2){

                    $result->badge = 'badge-primary';
                    $result->verifikasi = 'Sedang Verifikasi';
                    $result->pesanan = false;

                } elseif ($result->verifikasi == 0){

                    $result->badge = 'badge-danger';
                    $result->verifikasi = 'Ditolak';
                    $result->pesanan = false;

                }  else {

                    $result->badge = 'badge-success';
                    $result->verifikasi = 'Selesai';
                    $result->pesanan = true;

                }
            }

            $res = $results;

        } catch (Exception $err) {
            $res = 'Error: '.$err;
        }
        
        return view('riwayat/index')->with(array('datas'=>$res));
    }

    public function detail(Request $request){

        $id_pesanan = $request->route('id');
        $nim = auth()->user()->nim;
        
        try {

            $arr = array();
            $Pesanan = new Pesanan();
            $results = $Pesanan->getData($nim, $id_pesanan, 'single');

            if ($results->source_table == 0){

                $Legalisir = new Legalisir();
                $res = $Legalisir->getData($nim, $id_pesanan, 'single');

                for ($x=1; $x <= 12; $x++) {
    
                    $id = sprintf('%02d', $x);
    
                    $cat = array('Legalisir Ijazah','Legalisir Transkrip','Legalisir Piagam Cum Laude','Terjemahan Ijazah','Terjemahan Transkrip','Terjemahan Piagam Cumlaude','Legalisir Akreditasi Program Studi (Tanggal Lulus)','Legalisir Akreditasi Program Studi (Saat Ini)','Legalisir Akreditasi Institusi (Tanggal Lulus)','Legalisir Akreditasi Institusi (Saat Ini)','Legalisir Akreditasi Program Profesi - Spesialis (Tanggal Lulus)','Legalisir Akreditasi Program Profesi - Spesialis (Saat Ini)');
    
                    if ($res->{'dok_' . $id} != 0){
                        $temp = [
                            'jenis' => $cat[$x - 1],
                            'jumlah' => $res->{'dok_' . $id}
                        ];
    
                        array_push($arr, $temp);
    
                    }
                }
    
                $results->table = $arr;

            } else if ($results->source_table == 1){

                $Suket = new Suket();
                $res = $Suket->getData($nim, $id_pesanan, 'single');

                foreach ($res->dokumen_dipesan as $values) {
                    foreach ($values as $key => $value) {
                        $temp = [
                            'jenis' => $value,
                            'jumlah' => 1
                        ];
    
                        array_push($arr, $temp);
                    }
                }
                $results->table = $arr;

            } else if ($results->source_table == 2){

                $Lainnya = new Lainya();
                $res = $Lainnya->getData($nim, $id_pesanan, 'single');

                $temp = [
                    'jenis' => $res->dokumen_dipesan,
                    'jumlah' => 1
                ];
    
                array_push($arr, $temp);
    
                $results->table = $arr;

            }

        } catch (Exception $err) {
            $results = 'Error: '.$err;
        }

        // echo '<pre>';
        // print_r($results);

        return view('riwayat/detail')->with(array('data'=>$results));
    }

    public function ambil(Request $request){

        $id_pesanan = $request->route('id');
        $nim = auth()->user()->nim;
        
        try {

            $Pesanan = new Pesanan();
            $results = $Pesanan->getData($nim, $id_pesanan, 'single');

        } catch (Exception $err) {
            $results = 'Error: '.$err;
        }

        // echo '<pre>';
        // print_r($results);
        
        return view('riwayat/ambil')->with(array('data'=>$results));
    }

    public function download(Pesanan $pesanan)
    {
        if($pesanan->source_table=== 0) {
            $legalisir = Legalisir::where('id', $pesanan->id)->first();
            $filePath = 'legalisir/selesai/'.$legalisir->final_dokumen;

            if (!Storage::disk('local')->exists($filePath)) {
                abort('404'); 
            }
    
            return response()->download(storage_path('app' . DIRECTORY_SEPARATOR . ($filePath)), Str::of($filePath)->basename(), [], 'inline');
    
        } elseif ($pesanan->source_table=== 1) {
            $suket = Suket::where('id', $pesanan->id)->first();
            $filePath = 'suket/selesai/'.$suket->final_dokumen;

            if (!Storage::disk('local')->exists($filePath)) {
                abort('404'); 
            }
    
            return response()->download(storage_path('app' . DIRECTORY_SEPARATOR . ($filePath)), Str::of($filePath)->basename(), [], 'inline');
    
        } elseif ($pesanan->source_table=== 2) {
            $suket = Lainya::where('id', $pesanan->id)->first();
            $filePath = 'lainnya/selesai/'.$suket->final_dokumen;

            if (!Storage::disk('local')->exists($filePath)) {
                abort('404'); 
            }
    
            return response()->download(storage_path('app' . DIRECTORY_SEPARATOR . ($filePath)), Str::of($filePath)->basename(), [], 'inline');
    
        }
    }
}
