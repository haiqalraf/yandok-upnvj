@extends('layouts.app')

@section('content')

@if ($surat->verifikasi===1 && auth()->user()->is_admin==2)
    <form action="{{route('akpk.surat.detail', [ 
        'surat' => $surat, 
        'status' =>  2
        ])}}" method="post">
    @elseif ($surat->verifikasi===2 && auth()->user()->is_admin==3)
    <form action="{{route('dekan.surat.detail', [ 
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
                @elseif ($surat->verifikasi===0)
                    Ditolak
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
                            @if (in_array($surat->verifikasi, [2,3]))
                            <th>Dokumen Selesai</th>
                            @else
                            <th>Persyaratan</th>
                            @endif
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
                            @if ($surat->verifikasi===0 && auth()->user()->is_admin==2)
                            <td>{{$surat->komentar?$surat->komentar : "Tidak ada Catatan"}}</td>
                            @elseif ($surat->verifikasi===1 && auth()->user()->is_admin==2)
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
                                @elseif ($surat->verifikasi===2 && auth()->user()->is_admin==3)
                                    <td class="align-middle text-center">
                                        <label for="Upload" class="btn-light p-2 rounded" id="upload" name="upload">
                                            <input type="file" name="upload">
                                        </label>
                                        <p style="font-size: 10px; color: slategray;">Catatan : Harap untuk di kompress dalam bentuk
                                            RAR/ZIP sebelum di upload</p>
                                    </td>
                                @elseif ($surat->verifikasi===3 && auth()->user()->is_admin==3)
                                    <td class="align-middle text-center">
                                        <a href="{{route('dekan.download', [ 
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
        @if (!in_array($surat->verifikasi, [3,0]))
        <div class="d-flex justify-content-end">
            @if (auth()->user()->is_admin==3)
            <button type="submit" class="btn btn-sm btn-success pull-right">
                Proses
            </button>
            @else
            @if ($surat->verifikasi!==2)    
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#exampleModal">
                Tolak
            </button>
            <button type="submit" class="btn btn-sm btn-success pull-right">
                Proses
            </button>
            @endif
            @endif
        </div>
        @endif
    </div>
@if (!in_array($surat->verifikasi, [3,0]))
</form>
@endif
@if (auth()->user()->is_admin==2 && !in_array($surat->verifikasi, [2,0]))
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{route('akpk.surat.detail', ['surat' => $surat, 'status' => 0])}}" method="post" class="modal-dialog">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Batalkan Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="formtolak">Berikan Alasan Penolakan</label>
                    <textarea class="form-control" id="formtolak" rows="3" name="komentar"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Yakin</button>
            </div>
        </div>
    </form>
</div>
@endif
<br/>
<br/>
<br/>
<br/>
<br/>
@endsection