
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col bg-white rounded shadow p-3">
            <h3>Riwayat Pesanan Anda</h3>
            <hr>
            <div class="mb-4" style="font-size: 15px;">Berikut daftar riwayat pesanan anda</div>

                <table class="table table-bordered table-md table-responsive-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Kode Pemesanan</th>
                            <th>{{strtoupper($data->id)}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tanggal Pemesanan</td>
                            <td>{{date('d-m-y', strtotime($data->created_at))}}</td>
                        </tr>
                        <tr>
                            <td>Detail Status</td>
                            @if ($data->verifikasi == 1)

                                <td>Pesanan akan ditinjau oleh bagian AKPK</td>
                            
                            @elseif ($data->verifikasi == 2)

                                <td>Masih dalam peninjauan di bagian AKPK</td>

                            @else

                                <td>Sudah Selesai, harap mengambil dokumen di loket ULT dengan menunjukan <a class="text-info" href="{{ url('/riwayat/ambil') }}/{{$data->id}}">kode pesanan</a></td>

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
                                <td>
                                    @if ($data->verifikasi == 3)
                                    <a href="{{route('riwayat.download', [ 
                                        $data
                                        ])}}" class="btn btn-light p-2 rounded"><i class="fa fa-download"></i> Download</a>
                                    @endif
                                </td>
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