@extends('layouts.app')

@section('content')
@if ($legalisir->verifikasi===1 && auth()->user()->is_admin==2)
<form action="{{route('akpk.legalisir.detail', [ 
    'legalisir' => $legalisir, 
    'status' =>  2
    ])}}" method="post">
@elseif ($legalisir->verifikasi===2 && auth()->user()->is_admin==3)
<form action="{{route('dekan.legalisir.detail', [ 
    'legalisir' => $legalisir, 
    'status' =>  3
    ])}}" method="post" enctype="multipart/form-data">
@endif
@csrf
@method("PUT")
    <div class="container mt-3 mb-5">
        <h4 class="font-weight-bolder mb-5">Pemesanan Legalisir <span style="border-left: 2px solid #000;"></span> <span
                class="font-weight-lighter pl-2 ">
                @if ($legalisir->verifikasi===1)
                    Belum Diproses
                @elseif ($legalisir->verifikasi===2)
                    Sedang Diproses
                @elseif ($legalisir->verifikasi===3)
                    Sudah Diproses
                @endif
            </span>
        </h4>
        <div class="row mb-5">
            <div class="col p-3 bg-white rounded shadow">
                <table class="table table-bordered" style="width: 100%;">
                    <thead class="text-white" style="background-color: #06750F;">
                        <tr>
                            <th>Kode Pesanan</th>
                            <th>Daftar Pesanan</th>
                            <th>Jumlah </th>
                            <th>Persyaratan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftar_pesanan as $key => $item)
                        <tr>
                            @if ($loop->first)
                                <td rowspan="3" class="text-center align-middle">{{$legalisir->id}}</td>
                            @endif
                            <td>{{$key}}</td>
                            <td class="text-center">{{$item}}</td>

                            @if ($loop->first)
                                @if ($legalisir->verifikasi===1 && auth()->user()->is_admin==2)
                                    <td rowspan="3" class="align-middle text-center" style="font-size: 15px;">
                                        <div class="d-flex justify-content-center">
                                            <ol type="number" class="text-left" style="font-size: 13px;">
                                                <li>Scan FC Transkrip</li>
                                                <li>Surat permohonan yang ditujukan ke dekan</li>
                                                <li>Akte kelahiran / Akte Notaris</li>
                                                <li>Foto 3x4 hitam putih</li>
                                            </ol>
                                        </div>
                                        <br>
                                        <a href="{{route('akpk.download', [ 
                                            'filePath' => 'legalisir/'.$legalisir->file
                                            ])}}" class="btn btn-light p-2 rounded">Download <i class="fa fa-download"></i></a>
                                    </td>
                                @elseif ($legalisir->verifikasi===2 && auth()->user()->is_admin==3)
                                    <td class="align-middle text-center">
                                        <label for="Upload" class="btn-light p-2 rounded" id="upload" name="upload">
                                            <input type="file" name="upload">
                                        </label>
                                    </td>
                                @elseif ($legalisir->verifikasi===3 && auth()->user()->is_admin==3)
                                    <td class="align-middle text-center">
                                        <a href="{{route('dekan.download', [ 
                                            'filePath' => 'legalisir/selesai/'.$legalisir->final_dokumen
                                            ])}}" class="btn btn-light p-2 rounded">Download <i class="fa fa-download"></i></a>
                                    </td>
                                @endif
                                
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col bg-white rounded shadow" style="border-left: 20px solid #ecd714; border-radius: 8px;">
                <h6 class="text-left mt-2">Informasi Tambahan</h6>
                <hr style="background-color: #06750F;">
                <ul class="text-justify" style="font-size: 13px;">
                    <li>Kebutuhan : {{$legalisir->kebutuhan}}</li>
                    <li>Permintaan Khusus : {{$legalisir->keterangan}}</li>
                </ul>
            </div>
        </div>

        <hr>
        @if ($legalisir->verifikasi!==3)
        
            <button type="submit" class="btn btn-sm btn-success pull-right">
                Proses
            </button>
            @endif
            
            
    </div>
@if ($legalisir->verifikasi!==3)
</form>
@endif
<br/>
<br/>
<br/>
<br/>
<br/>
@endsection