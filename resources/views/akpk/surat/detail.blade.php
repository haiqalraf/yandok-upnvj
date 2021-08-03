@extends('layouts.app')

@section('content')

@if ($surat->verifikasi===1)
    <form action="{{route('akpk.surat.detail', [ 
        'surat' => $surat, 
        'status' =>  2
        ])}}" method="post">
    @elseif ($surat->verifikasi===2)
    <form action="{{route('akpk.surat.detail', [ 
        'surat' => $surat, 
        'status' =>  3
        ])}}" method="post" enctype="multipart/form-data">
    @endif
    @csrf
    @method("PUT")
    <div class="container mt-3 mb-5">
        <h4 class="font-weight-bolder mb-5">Pemesanan Surat <span style="border-left: 2px solid #000;"></span> <span
                class="font-weight-lighter pl-2 ">
                @if ($surat->verifikasi===1)
                    Belum Diproses
                @elseif ($surat->verifikasi===2)
                    Sedang Diproses
                @elseif ($surat->verifikasi===3)
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
                                <td rowspan="3" class="text-center align-middle">{{$surat->id}}</td>
                            @endif
                            <td>{{$key}}</td>
                            <td class="text-center">{{$item}}</td>

                            @if ($loop->first)
                                @if ($surat->verifikasi===1)
                                    <td rowspan="3" class="align-middle text-center" style="font-size: 15px;">
                                        <div class="d-flex justify-content-center">
                                            <ol type="number" class="text-left" style="font-size: 13px;">
                                                @if (strpos($key, 'Pengganti'))
                                                <li>Scan FC Transkrip</li>
                                                <li>Surat permohonan yang ditujukan ke dekan</li>
                                                <li>Akte kelahiran / Akte Notaris</li>
                                                <li>Foto 3x4 hitam putih</li>
                                                @elseif (strpos($key, 'Perubahan')||strpos($key, 'Ralat'))
                                                <li>Scan FC SKPI</li>
                                                <li>Surat permohonan yang ditujukan ke dekan</li>
                                                <li>Surat Keterangan Hilang Dari Polisi</li>
                                                <li>Foto 3x4 hitam putih</li>
                                                @elseif (strpos($key, 'Alumni'))
                                                <li>Scan Ijazah dan Transkrip Nilai</li>
                                                @endif
                                                {{-- <li>Scan FC Transkrip</li>
                                                <li>Surat permohonan yang ditujukan ke dekan</li>
                                                <li>Akte kelahiran / Akte Notaris</li>
                                                <li>Foto 3x4 hitam putih</li> --}}
                                            </ol>
                                        </div>
                                        <br>
            
                                        <a href="{{route('akpk.download', [ 
                                            'filePath' => 'suket/'.$surat->file
                                            ])}}" class="btn btn-light p-2 rounded">Download <i class="fa fa-download"></i></a>
                                    </td>
                                @elseif ($surat->verifikasi===2)
                                    <td class="align-middle text-center">
                                        <label for="Upload" class="btn-light p-2 rounded" id="upload" name="upload">
                                            <input type="file" name="upload">
                                        </label>
                                    </td>
                                @elseif ($surat->verifikasi===3)
                                    <td class="align-middle text-center">
                                        <a href="{{route('akpk.download', [ 
                                            'filePath' => 'suket/selesai/'.$surat->final_dokumen
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

        {{-- <div class="row">
            <div class="col bg-white rounded shadow" style="border-left: 20px solid #ecd714; border-radius: 8px;">
                <h6 class="text-left mt-2">Informasi Tambahan</h6>
                <hr style="background-color: #06750F;">
                <ul class="text-justify" style="font-size: 13px;">
                    <li>Kebutuhan : {{$surat->kebutuhan}}</li>
                    <li>Permintaan Khusus : {{$surat->keterangan}}</li>
                </ul>
            </div>
        </div> --}}

        <hr>
        @if ($surat->verifikasi!==3)
            <button type="submit" class="btn btn-sm btn-success pull-right">
                Proses
            </button>
            @endif
            
            
    </div>
@if ($surat->verifikasi!==3)
</form>
@endif
<br/>
<br/>
<br/>
<br/>
<br/>
@endsection