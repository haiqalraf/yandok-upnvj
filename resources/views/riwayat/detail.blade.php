
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col bg-white rounded shadow p-3">
            <div class="d-flex justify-content-end">
               <a href="{{route('riwayat')}}" class="btn btn-sm btn-success"><i class="fa fa-arrow-left"></i> Kembali</a> 
            </div>
            <h3>Riwayat Pesanan Anda</h3>
            <hr>
            <div class="mb-4" style="font-size: 1rem;">Berikut daftar riwayat pesanan anda</div>

                <table class="table table-bordered table-md table-responsive-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Kode Pemesanan</th>
                            <th>{{strtoupper($data->id)}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nama Pemesan</td>
                            <td>{{$data->name}}</td>
                        </tr>
                        <tr>
                            <td>Fakultas</td>
                            <td>{{$data->FAK}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pemesanan</td>
                            <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                        </tr>
                        <tr>
                            <td>Detail Status</td>
                            @if ($data->verifikasi == 0)
                                @if ($data->getCommentIfExists($data))
                                <td>{{$data->getCommentIfExists($data)}}</td>
                                @else
                                <td>Dokumen yang Anda unggah tidak sesuai persyaratan. Harap di cek lagi dengan teliti dan lakukan pesanan ulang</td>
                                @endif

                            @elseif ($data->verifikasi == 1)

                                <td>Pesanan Anda akan ditinjau</td>
                            
                            @elseif ($data->verifikasi == 2)

                                <td>Pesanan Anda sedang diproses</td>

                            @elseif($data->verifikasi == 3)
                                @if ($data->tujuan==2)
                                <td>Sudah Selesai, harap melakukan pembayaran <a class="text-info" href="{{ url('/riwayat/ambil') }}/{{$data->id}}">di sini!</a></td>
                                @else
                                <td>Sudah Selesai, harap mengambil dokumen di loket ULT dengan menunjukan <a class="text-info" href="{{ url('/riwayat/ambil') }}/{{$data->id}}">kode pesanan</a></td>
                                @endif
                            @elseif($data->verifikasi == 4)
                                @if ($data->tujuan==2)
                                    <td>Bukti Pembayaran sedang diverifikasi</td>
                                @else
                                    <td>Sudah Selesai, harap mengambil dokumen di loket ULT dengan menunjukan <a class="text-info" href="{{ url('/riwayat/ambil') }}/{{$data->id}}">kode pesanan</a></td>
                                @endif
                            @elseif($data->verifikasi == 5)
                                @if ($data->tujuan==2)
                                    <td>Bukti Pembayaran Telah dikonfirmasi dan Pesanan sedang dikirim dengan resi <span class="text-info">Dummy</span></td>
                                @else
                                    <td>Sudah Selesai, harap mengambil dokumen di loket ULT dengan menunjukan <a class="text-info" href="{{ url('/riwayat/ambil') }}/{{$data->id}}">kode pesanan</a></td>
                                @endif
                            @endif
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered table-md table-responsive-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Jenis Dokumen</th>
                            <th>Jumlah Item</th>
                            <th>Unduh Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $x = 0
                        @endphp
                        @foreach($data->table as $table)
                            @php
                            $x++
                            @endphp
                            <tr>
                                <td>{{$x}}</td>
                                <td>{{$table['jenis']}}</td>
                                <td>{{intval($table['jumlah'])}}</td>
                                @if ($loop->first)
                                <td rowspan="{{count($data->table)}}">
                                    @if ($data->verifikasi >= 3)
                                    <div class="d-flex w-100 h-100 justify-content-center align-items-center">
                                        <a href="{{route('riwayat.download', [ 
                                            $data
                                            ])}}" class="btn btn-light p-2 rounded"><i class="fa fa-download"></i> Download</a>
                                        @elseif ($data->verifikasi < 3)
                                        <span style="justify-content: center;
                                            display: flex;
                                            width: 100%;
                                            font-weight: 600">-</span>
                                    </div>
                                    @endif
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection